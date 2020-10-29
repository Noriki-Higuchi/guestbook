<?php


namespace App\Subscribers;


use App\Entity\Comment;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CommentSubscribers implements EventSubscriberInterface
{

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return [
            // レコード追加する直前のイベントリスナー
            BeforeEntityPersistedEvent::class => ['setCreatedAtOfComment']
        ];
    }

    /**
     * @param BeforeEntityPersistedEvent $event
     * 追加したイベントリスナーの処理の中身
     */
    public function setCreatedAtOfComment(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if(!($entity instanceof Comment)) {
            return;
        }

        $entity->setCreatedAt(new DateTime('NOW'));
    }
}