<?php

namespace Lanparty\UsuariBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Lanparty\UsuariBundle\Entity\Torneig;
use Lanparty\UsuariBundle\Form\TorneigType;

/**
 * Torneig controller.
 *
 */
class TorneigController extends Controller
{

    /**
     * Lists all Torneig entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UsuariBundle:Torneig')->findAll();

        return $this->render('UsuariBundle:Torneig:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Torneig entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Torneig();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('torneig_show', array('id' => $entity->getId())));
        }

        return $this->render('UsuariBundle:Torneig:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Torneig entity.
    *
    * @param Torneig $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Torneig $entity)
    {
        $form = $this->createForm(new TorneigType(), $entity, array(
            'action' => $this->generateUrl('torneig_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Torneig entity.
     *
     */
    public function newAction()
    {
        $entity = new Torneig();
        $form   = $this->createCreateForm($entity);

        return $this->render('UsuariBundle:Torneig:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Torneig entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuariBundle:Torneig')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Torneig entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UsuariBundle:Torneig:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Torneig entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuariBundle:Torneig')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Torneig entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UsuariBundle:Torneig:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Torneig entity.
    *
    * @param Torneig $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Torneig $entity)
    {
        $form = $this->createForm(new TorneigType(), $entity, array(
            'action' => $this->generateUrl('torneig_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Torneig entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuariBundle:Torneig')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Torneig entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('torneig_edit', array('id' => $id)));
        }

        return $this->render('UsuariBundle:Torneig:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Torneig entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UsuariBundle:Torneig')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Torneig entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('torneig'));
    }

    /**
     * Creates a form to delete a Torneig entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('torneig_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
