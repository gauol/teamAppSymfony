<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Entity\User;
use AppBundle\Form\EventType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/panel", name="panel")
 */
class PanelController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function panelAction(Request $request){
        return $this->render(':Panel:panel.html.twig');
    }

    /**
     * @Route("/events", name="Events")
     */
    public function eventsAction(Request $request){
        $events = $this->getDoctrine()->getRepository(Event::class)->getUpcoming();
        return $this->render(':Panel:events.html.twig',
            array(
                'events' => $events
            ));
    }

    /**
     * @Route("/newEvent", name="NewEvent")
     */
    public function newEventAction(Request $request){
        $event = new Event();
        $event->setDate(new \DateTime());
        $event->setStart(new \DateTime('08:00'));
        $event->setEnd(new \DateTime('18:00'));

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $event = $form->getData();
            $this->addFlash(
                'info',
                'Dodałeś event!'
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('panelEvents');
        }

        return $this->render(':Panel/Event:newEvent.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/editEvent/{event}", name="EditEvent")
     */
    public function editEventAction(Request $request, Event $event){
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $event = $form->getData();
            $this->addFlash(
                'info',
                'Zapisano zmiany!'
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('panelEventDetails', array('event' => $event->getId()));
        }

        return $this->render(':Panel/Event:editEvent.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/event/{event}", name="EventDetails")
     */
    public function eventDetailsAction(Request $request, Event $event)
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findByEnabled(true);
        $usersJson = [];
        /** @var User $user */
        foreach ($users as $user){
            $usersJson[] = ['firstname' => $user->getFirstname(), 'lastname' => $user->getLastname()];
        }
        return $this->render(':Panel/Event:eventDetails.html.twig', array(
            'event' => $event,
            'users' => json_encode($usersJson)
        ));
    }

    /**
     * @Route("/event/{event}/{user}", name="Invite")
     */
    public function inviteAction(Request $request, Event $event, User $user)
    {
        return $this->render(':Panel/Event:eventDetails.html.twig', array(
            'event' => $event,
        ));
    }

    /**
     * @Route("/users", name="Users")
     */
    public function usersAction(Request $request){
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render(':Panel:users.html.twig',
            array(
                'users' => $users
            ));
    }

    /**
     * @Route("/users/{user}", name="UserDetails")
     */
    public function userDetailsAction(Request $request, User $user)
    {
        return $this->render(':Panel/Event:eventDetails.html.twig', array(
            'user' => $user,
        ));
    }

}
