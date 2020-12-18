<?php

if (!function_exists('getTotalTime')) {
    function getTotalTime($secretTime)
    {
        $currentTime = date("Y-m-d H:i:s", time() + 60 * 60 * 6);
        $differentSecretCreated = abs(strtotime($currentTime) - strtotime($secretTime));

        $differentSecretYearCreated = floor($differentSecretCreated / (365 * 60 * 60 * 24));
        $differentValue = $differentSecretYearCreated;
        $differentDescription = "year(s)";

        if ($differentValue == 0) {
            $differentSecretMonthCreated = floor(($differentSecretCreated -
                    $differentSecretYearCreated * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $differentValue = $differentSecretMonthCreated;
            $differentDescription = "month(s)";

            if ($differentValue == 0) {
                $differentSecretDayCreated = floor(($differentSecretCreated -
                        $differentSecretYearCreated * 365 * 60 * 60 * 24 -
                        $differentSecretMonthCreated * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                $differentValue = $differentSecretDayCreated;
                $differentDescription = "days(s)";

                if ($differentValue == 0) {
                    $differentSecretHourCreated = floor(($differentSecretCreated -
                            $differentSecretYearCreated * 365 * 60 * 60 * 24 -
                            $differentSecretMonthCreated * 30 * 60 * 60 * 24 -
                            $differentSecretDayCreated * 60 * 60 * 24) / (60 * 60));
                    $differentValue = $differentSecretHourCreated;
                    $differentDescription = "hour(s)";

                    if ($differentValue == 0) {
                        $differentSecretMinutesCreated = floor(($differentSecretCreated -
                                $differentSecretYearCreated * 365 * 60 * 60 * 24 -
                                $differentSecretMonthCreated * 30 * 60 * 60 * 24 -
                                $differentSecretDayCreated * 60 * 60 * 24 -
                                $differentSecretHourCreated * 60 * 60) / 60);
                        $differentValue = $differentSecretMinutesCreated;
                        $differentDescription = "minute(s)";

                        if ($differentValue == 0) {
                            $differentSecretSecondCreated = floor($differentSecretCreated -
                                $differentSecretYearCreated * 365 * 60 * 60 * 24 -
                                $differentSecretMonthCreated * 30 * 60 * 60 * 24 -
                                $differentSecretDayCreated * 60 * 60 * 24 -
                                $differentSecretHourCreated * 60 * 60 -
                                $differentSecretMinutesCreated * 60);
                            $differentValue = $differentSecretSecondCreated;
                            $differentDescription = "second(s)";
                        }
                    }
                }
            }
        }

        return $differentValue . " " . $differentDescription;
    }
}