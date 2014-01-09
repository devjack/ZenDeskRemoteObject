<?php

namespace ZenDesk\Rest\Client\Builder;

use RestRemoteObject\Client\Rest\Context;
use RestRemoteObject\Client\Rest\Builder\AbstractBuilder;

class TicketBuilder extends AbstractBuilder
{
    protected $relatedClass = 'ZenDesk\Service\Remote\TicketServiceInterface';

    public function persist(Context $context)
    {
        $params = $context->getResourceBinder()->getParams();
        /** @var \ZenDesk\Entity\Ticket $ticket */
        $ticket = $params[0];
        $user = $ticket->getRequester();

        $tags = $ticket->getTags();
        $list = array();
        foreach ($tags as $tag) {
            $list[] = $tag->getName();
        }

        $data = array(
            'ticket' => array(
                'subject' => $ticket->getSubject(),
                'comment' => array(
                    'body' => $ticket->getDescription(),
                ),
                'tags' => $list,
            ),
        );

        if ($user) {
            $data['ticket']['requester'] = array(
                'name' => $user->getName(),
                'email' => $user->getEmail(),
            );
            if ($user->getId()) {
                $data['ticket']['submitter_id'] = $user->getId();
            }
        } else if ($ticket->getRequesterId()) {
            $data['ticket']['submitter_id'] = $ticket->getRequesterId();
        }

        $context
            ->getResourceBinder()
            ->setParams(json_encode($data));
    }

    public function save(Context $context)
    {
        $params = $context->getResourceBinder()->getParams();
        /** @var \ZenDesk\Entity\Ticket $ticket */
        $ticket = $params[0];

        $tags = $ticket->getTags();
        $list = array();
        foreach ($tags as $tag) {
            $list[] = $tag->getName();
        }

        $data = array(
            'ticket' => array(
                'subject' => $ticket->getSubject(),
                'tags' => $list,
            ),
        );

        $comment = $ticket->dequeueComment();

        if ($comment) {
            $data['ticket']['comment'] = array(
                'body' => $comment->getBody(),
                'author_id' => $comment->getAuthorId(),
            );
        }

        $context
            ->getResourceBinder()
            ->setParams(json_encode($data));
    }

    public function close(Context $context)
    {
        $data = array(
            'ticket' => array(
                'status' => 'closed',
            ),
        );

        $context
            ->getResourceBinder()
            ->setParams(json_encode($data));
    }
}