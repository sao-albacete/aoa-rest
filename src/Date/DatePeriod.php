<?php
namespace Aoa\Util;

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

    public function __construct($fromDay, $fromMonth, $toDay, $toMonth)
    {
        $year = (new \DateTime())->format('Y');
        $this->startDate = (new \DateTime())->setTime($year, $fromMonth, $fromDay);
        $this->endDate = (new \DateTime())->setTime($year, $toDay, $toMonth);
    }

    public function inPeriod(\DateTime $date)
    {
        
    }
}
