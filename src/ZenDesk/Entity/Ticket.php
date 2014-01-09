<?php

namespace ZenDesk\Entity;

use SplQueue;

use RestRemoteObject\Client\Rest\RestParametersAware;

use Zend\Stdlib\Hydrator\Filter\FilterInterface;
use Zend\Stdlib\Hydrator\Filter\FilterProviderInterface;

use ZenDesk\Entity\Hydratation\Filter\TicketFilter;

class Ticket extends AbstractEntity implements RestParametersAware, FilterProviderInterface
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $url;

    /** @var int */
    protected $external_id;

    /** @var string */
    protected $type;

    /** @var string */
    protected $subject;

    /** @var string */
    protected $description;

    /** @var string */
    protected $priority;

    /** @var string */
    protected $status = 'new';

    /** @var string */
    protected $recipient;

    /** @var int */
    protected $requester_id;

    /** @var int */
    protected $submitter_id;

    /** @var int */
    protected $assignee_id;

    /** @var int */
    protected $organization_id;

    /** @var int */
    protected $group_id;

    /** @var int[] */
    protected $collaborator_ids = array();

    /** @var int */
    protected $forum_topic_id;

    /** @var int */
    protected $problem_id;

    /** @var bool */
    protected $has_incident;

    /** @var string */
    protected $due_at;

    /** @var Tag[] */
    protected $tags = array(); // init to avoid lazy loading

    /** @var  */
    protected $via;

    /** @var array */
    protected $custom_fields;

    /** @var  */
    protected $satisfaction_rating;

    /** @var array */
    protected $sharing_agreement_ids;

    /** @var array */
    protected $followup_ids;

    /** @var int */
    protected $ticket_form_id;

    /** @var string */
    protected $created_at;

    /** @var string */
    protected $updated_at;

    /** @var User */
    protected $requester;

    /**
     * @var Comment[]
     */
    protected $comments;

    /**
     * @var SplQueue
     */
    protected $commentQueue;

    /**
     * @param Ticket $fresh
     */
    public function refresh($fresh)
    {
        $this->setId($fresh->getId());
        $this->setUrl($fresh->getUrl());
        $this->setExternalId($fresh->getExternalId());
        $this->setType($fresh->getType());
        $this->setSubject($fresh->getSubject());
        $this->setDescription($fresh->getDescription());
        $this->setPriority($fresh->getPriority());
        $this->setStatus($fresh->getStatus());
        $this->setRecipient($fresh->getRecipient());
        $this->setRequesterId($fresh->getRequesterId());
        $this->setSubmitterId($fresh->getSubmitterId());
        $this->setAssigneeId($fresh->getAssigneeId());
        $this->setOrganizationId($fresh->getOrganizationId());
        $this->setGroupId($fresh->getGroupId());
        $this->setCollaboratorIds($fresh->getCollaboratorIds());
        $this->setForumTopicId($fresh->getForumTopicId());
        $this->setProblemId($fresh->getProblemId());
        $this->setHasIncident($fresh->getHasIncident());
        $this->setDueAt($fresh->getDueAt());
        $this->setTags($fresh->getTags());
        $this->setVia($fresh->getVia());
        $this->setCustomFields($fresh->getCustomFields());
        $this->setSatisfactionRating($fresh->getSatisfactionRating());
        $this->setSharingAgreementIds($fresh->getSharingAgreementIds());
        $this->setFollowupIds($fresh->getFollowupIds());
        $this->setTicketFormId($fresh->getTicketFormId());
        $this->setCreatedAt($fresh->getCreatedAt());
        $this->setUpdatedAt($fresh->getUpdatedAt());
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param User $requester
     */
    public function setRequester(User $requester)
    {
        $this->setRequesterId($requester->getId());
        $this->requester = $requester;
    }

    /**
     * @return User
     */
    public function getRequester()
    {
        return $this->requester;
    }

    /**
     * @param int $requester_id
     */
    public function setRequesterId($requester_id)
    {
        $this->requester_id = $requester_id;
    }

    /**
     * @return int
     */
    public function getRequesterId()
    {
        return $this->requester_id;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param Tag[]|array $tags
     */
    public function setTags($tags)
    {
        $list = array();
        foreach ($tags as $nameOrTag) {
            if (is_string($nameOrTag)) {
                $tag = new Tag();
                $tag->setName($nameOrTag);
                $list[] = $tag;
            } else {
                $list[] = $nameOrTag;
            }
        }
        $this->tags = $list;
    }

    /**
     * @param bool $refresh
     * @return Tag[]
     */
    public function getTags($refresh = false)
    {
        if (null === $this->tags || $refresh) {
            $remote = $this->getRemoteService();
            $tags = $remote->getTags($this);
            $this->setTags($tags);
        }
        return $this->tags;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $assignee_id
     */
    public function setAssigneeId($assignee_id)
    {
        $this->assignee_id = $assignee_id;
    }

    /**
     * @return int
     */
    public function getAssigneeId()
    {
        return $this->assignee_id;
    }

    /**
     * @param \int[] $collaborator_ids
     */
    public function setCollaboratorIds($collaborator_ids)
    {
        $this->collaborator_ids = $collaborator_ids;
    }

    /**
     * @return \int[]
     */
    public function getCollaboratorIds()
    {
        return $this->collaborator_ids;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param array $custom_fields
     */
    public function setCustomFields($custom_fields)
    {
        $this->custom_fields = $custom_fields;
    }

    /**
     * @return array
     */
    public function getCustomFields()
    {
        return $this->custom_fields;
    }

    /**
     * @param string $due_at
     */
    public function setDueAt($due_at)
    {
        $this->due_at = $due_at;
    }

    /**
     * @return string
     */
    public function getDueAt()
    {
        return $this->due_at;
    }

    /**
     * @param int $external_id
     */
    public function setExternalId($external_id)
    {
        $this->external_id = $external_id;
    }

    /**
     * @return int
     */
    public function getExternalId()
    {
        return $this->external_id;
    }

    /**
     * @param array $followup_ids
     */
    public function setFollowupIds($followup_ids)
    {
        $this->followup_ids = $followup_ids;
    }

    /**
     * @return array
     */
    public function getFollowupIds()
    {
        return $this->followup_ids;
    }

    /**
     * @param int $forum_topic_id
     */
    public function setForumTopicId($forum_topic_id)
    {
        $this->forum_topic_id = $forum_topic_id;
    }

    /**
     * @return int
     */
    public function getForumTopicId()
    {
        return $this->forum_topic_id;
    }

    /**
     * @param int $group_id
     */
    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;
    }

    /**
     * @return int
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    /**
     * @param boolean $has_incident
     */
    public function setHasIncident($has_incident)
    {
        $this->has_incident = $has_incident;
    }

    /**
     * @return boolean
     */
    public function getHasIncident()
    {
        return $this->has_incident;
    }

    /**
     * @param int $organization_id
     */
    public function setOrganizationId($organization_id)
    {
        $this->organization_id = $organization_id;
    }

    /**
     * @return int
     */
    public function getOrganizationId()
    {
        return $this->organization_id;
    }

    /**
     * @param string $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $problem_id
     */
    public function setProblemId($problem_id)
    {
        $this->problem_id = $problem_id;
    }

    /**
     * @return int
     */
    public function getProblemId()
    {
        return $this->problem_id;
    }

    /**
     * @param string $recipient
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param mixed $satisfaction_rating
     */
    public function setSatisfactionRating($satisfaction_rating)
    {
        $this->satisfaction_rating = $satisfaction_rating;
    }

    /**
     * @return mixed
     */
    public function getSatisfactionRating()
    {
        return $this->satisfaction_rating;
    }

    /**
     * @param array $sharing_agreement_ids
     */
    public function setSharingAgreementIds($sharing_agreement_ids)
    {
        $this->sharing_agreement_ids = $sharing_agreement_ids;
    }

    /**
     * @return array
     */
    public function getSharingAgreementIds()
    {
        return $this->sharing_agreement_ids;
    }

    /**
     * @param int $submitter_id
     */
    public function setSubmitterId($submitter_id)
    {
        $this->submitter_id = $submitter_id;
    }

    /**
     * @return int
     */
    public function getSubmitterId()
    {
        return $this->submitter_id;
    }

    /**
     * @param int $ticket_form_id
     */
    public function setTicketFormId($ticket_form_id)
    {
        $this->ticket_form_id = $ticket_form_id;
    }

    /**
     * @return int
     */
    public function getTicketFormId()
    {
        return $this->ticket_form_id;
    }

    /**
     * @param string $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $via
     */
    public function setVia($via)
    {
        $this->via = $via;
    }

    /**
     * @return mixed
     */
    public function getVia()
    {
        return $this->via;
    }

    public function getCommentQueue()
    {
        if (null === $this->commentQueue) {
            $this->commentQueue = new SplQueue();
        }

        return $this->commentQueue;
    }

    /**
     * @param Comment $comment
     */
    public function enqueueComment(Comment $comment)
    {
        $commentQueue = $this->getCommentQueue();
        $commentQueue->enqueue($comment);
    }

    /**
     * @param Comment[] $comments
     */
    public function enqueueComments(array $comments)
    {
        foreach ($comments as $comment) {
            $this->enqueueComment($comment);
        }
    }

    /**
     * @return Comment|null
     */
    public function dequeueComment()
    {
        $commentQueue = $this->getCommentQueue();
        if ($commentQueue->count() == 0) {
            return null;
        }
        return $commentQueue->dequeue();
    }

    /**
     * @param bool $refresh
     * @return Comment[]
     */
    public function getComments($refresh = false)
    {
        if (null === $this->comments || $refresh) {
            $remote = $this->getRemoteService();
            $comments = $remote->getComments($this);
            $this->setComments($comments);
        }
        return $this->comments;
    }

    public function setComments(array $comments)
    {
        $this->comments = $comments;
    }

    public function close()
    {
        $remote = $this->getRemoteService();
        $fresh = $remote->close($this);
        $this->refresh($fresh);
    }

    public function save()
    {
        $remoteService = $this->getRemoteService();

        $commentsCount = $this->getCommentQueue()->count();
        if ($commentsCount) {
            $this->comments = null; // force lazy loading of the new comments
        }

        $commentsCount = max(1, $commentsCount);
        for ($i = 0; $i < $commentsCount; $i++) {
            $fresh = $remoteService->save($this);
        }

        $this->refresh($fresh);
    }

    public function getRestParameters()
    {
        return array(
            'ticket' => $this->getId(),
        );
    }

    /**
     * Provides a filter for hydration
     *
     * @return FilterInterface
     */
    public function getFilter()
    {
        return new TicketFilter();
    }
}