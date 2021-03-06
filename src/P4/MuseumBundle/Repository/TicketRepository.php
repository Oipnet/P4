<?php

namespace P4\MuseumBundle\Repository;

/**
 * TicketRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TicketRepository extends \Doctrine\ORM\EntityRepository
{
	public function getTickets()
  	{
    $qb = $this->createQueryBuilder('t');
    // On fait une jointure avec l'entité Category avec pour alias « t »
    $qb
      ->innerJoin('t.ticketowner', 'ti')
      ->addSelect('ti');
    return $qb
      ->getQuery()
      ->getResult()
      ;
  }

  public function countByValiditydate($validitydate)
  {
    $qb = $this->createQueryBuilder('t');
    $qb
      ->select('count(t.id)')
      ->where('t.validitydate = :validitydate')
      ->setParameter('validitydate', $validitydate);

    return $qb->getQuery()->getSingleScalarResult();
  }

  public function getTicketlistByOrder($order)
  {
    $qb = $this->createQueryBuilder('t');
    $qb
      ->where('t.orders = :order')
      ->setParameter('order', $order);

    return $qb
      ->getQuery()
      ->getResult();
  }

  public function countByOrder($order)
  {
    $qb = $this->createQueryBuilder('t');
    $qb
      ->select('count(t.id)')
      ->where('t.orders = :orders')
      ->setParameter('orders', $order);

  return $qb->getQuery()->getSingleScalarResult();
  }

}
