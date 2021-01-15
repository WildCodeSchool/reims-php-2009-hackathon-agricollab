<?php

namespace App\Service;

use App\Entity\Equipment;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Calculator
{
    private SessionInterface $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function estimate(): ?array
    {
        $size = $this->session->get('size');
        $age = $this->session->get('age');
        $usage = $this->session->get('usage');
        $lifeTime = 8;

        if (!isset($size, $age, $usage)) {
            return null;
        }

        switch ($size) {
            case 'small':
                $buyValueMin = 20000;
                $buyValueMax = 120000;
                break;
            case 'medium':
                $buyValueMin = 130000;
                $buyValueMax = 230000;
                break;
            case 'large':
                $buyValueMin = 240000;
                $buyValueMax = 440000;
                break;
            default:
        }

        switch ($age) {
            case 'old':
                $residualRatio = 0.2;
                break;
            case 'average':
                $residualRatio = 0.5;
                break;
            case 'new':
                $residualRatio = 0.8;
                break;
            default:
        }

        switch ($usage) {
            case 'low':
                $workTime = 400;
                break;
            case 'moderate':
                $workTime = 800;
                break;
            case 'intense':
                $workTime = 1200;
                break;
            default:
        }

        $simpleEstimationMin = (($buyValueMin * $residualRatio) / $lifeTime) / $workTime;
        $simpleEstimationMax = (($buyValueMax * $residualRatio) / $lifeTime) / $workTime;

        return [
            'min' => round($simpleEstimationMin, 2),
            'max' => round($simpleEstimationMax, 2)
        ];
    }
    public function fineEstimate(Equipment $equipment): ?float
    {
        $buyValue = $equipment->getBuyValue();
        $residualValue = $equipment->getResidualValue();
        $workTime = $equipment->getWorkTime();
        $lifeTime = $equipment->getLifetime();
        $horsepower = $equipment->getHorsepower();

        $simpleEstimation = (($buyValue - $residualValue) / $lifeTime) / $workTime;

        if (!isset($horsepower)) {
            return round($simpleEstimation, 2);
        }

        $complexeEstimation = ($simpleEstimation + ($horsepower / 10) * 0.65 +($horsepower * 0.36));

        return round($complexeEstimation, 2);
    }
}
