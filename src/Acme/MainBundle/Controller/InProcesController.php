<?php

namespace Acme\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\MainBundle\Entity\InProces;
use Acme\MainBundle\Form\InProcesType;

/**
 * InProces controller.
 *
 * @Route("/inproces")
 */
class InProcesController extends Controller
{

    /**
     * Lists all InProces entities.
     *
     * @Route("/", name="inproces")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeMainBundle:InProces')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new InProces entity.
     *
     * @Route("/", name="inproces_create")
     * @Method("POST")
     * @Template("AcmeMainBundle:InProces:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new InProces();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('inproces_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a InProces entity.
     *
     * @param InProces $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(InProces $entity)
    {
        $form = $this->createForm(new InProcesType(), $entity, array(
            'action' => $this->generateUrl('inproces_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new InProces entity.
     *
     * @Route("/new", name="inproces_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new InProces();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a InProces entity.
     *
     * @Route("/{id}", name="inproces_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeMainBundle:InProces')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InProces entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing InProces entity.
     *
     * @Route("/{id}/edit", name="inproces_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeMainBundle:InProces')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InProces entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a InProces entity.
    *
    * @param InProces $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(InProces $entity)
    {
        $form = $this->createForm(new InProcesType(), $entity, array(
            'action' => $this->generateUrl('inproces_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing InProces entity.
     *
     * @Route("/{id}", name="inproces_update")
     * @Method("PUT")
     * @Template("AcmeMainBundle:InProces:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeMainBundle:InProces')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InProces entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('inproces_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a InProces entity.
     *
     * @Route("/{id}", name="inproces_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeMainBundle:InProces')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find InProces entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('inproces'));
    }

    /**
     * Creates a form to delete a InProces entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('inproces_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
