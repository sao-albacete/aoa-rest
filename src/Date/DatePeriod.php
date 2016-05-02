<?php
namespace Aoa\Date;

/**
 * Class DatePeriod
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class DatePeriod
{
    /**
     * @var \DateTime
     */
    private $startDate;
    /**
     * @var \DateTime
     */
    private $endDate;

    public function __construct($fromDay, $fromMonth, $toDay, $toMonth, $year = null)
    {
        $year = isset($year) ? $year : (new \DateTime())->format('Y');
        $this->startDate = (new \DateTime())->setDate($year, $fromMonth, $fromDay)->setTime(0, 0, 0);
        $this->endDate = (new \DateTime())->setDate($year, $toMonth, $toDay)->setTime(23, 59, 59);
    }

    /**
     * Check if the received date is in period
     *
     * @param \DateTime $date
     * @return bool
     */
    public function inPeriod(\DateTime $date)
    {
        return $date >= $this->startDate && $date <= $this->endDate;
    }
}
