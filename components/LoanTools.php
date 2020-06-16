<?php

namespace app\components;

class LoanTools
{

    /**
     * @param int $loanSum total loan sum
     * @param float $percentYear year percent for loan
     * @param int $months loan period in months
     * @return array
     */
    public static function getLoanTable($loanSum, $yearPercent, $months)
    {
        $data = [];
        $percentPerMonth = $yearPercent / 12 / 100;
        $loanRemainSum = $loanSum;
        $k = self::getCoefficient($yearPercent, $months);
        for($month = 1; $month <= $months; $month++) {
            $sumPerMonth = round($loanSum * $k, 2);
            $percentSumPerMonth = round($loanRemainSum * $percentPerMonth, 2);
            $sumForLoan = $sumPerMonth - $percentSumPerMonth;
            $loanRemainSum -= $sumForLoan;
            $data[$month] = [
                'sumPerMonth' => $sumPerMonth,
                'percentSumPerMonth' => $percentSumPerMonth,
                'sumForLoan' => $sumForLoan,
                'loanRemainSum' => $loanRemainSum
            ];
        }

        return $data;
    }

    /**
     * @param float $yearPercent year percent for loan
     * @param int $period loan period in months
     * @return float|int
     */
    public static function getCoefficient($yearPercent, $period)
    {
        $i = $yearPercent / 12 / 100;
        $k = ($i * pow((1 + $i), $period)) / (pow((1 + $i), $period) - 1);

        return $k;
    }

}