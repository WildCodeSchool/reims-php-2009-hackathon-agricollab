<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Calculator
{
    private SessionInterface $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    public function estimate(): ?float
    {
        $buyValue = $this->session->get('size');
        $residualValue = $this->session->get('age');
        $workTime = $this->session->get('usage');
        $lifeTime = 8;

        if (!isset($buyValue, $residualValue, $workTime)) {
            return null;
        }
        switch ($buyValue) {
            case 'small':
                $buyValue = 20000;
                break;
            case 'medium':
                $buyValue = 130000;
                break;
            case 'large':
                $buyValue = 240000;
                break;
            default:
        }

        switch ($residualValue) {
            case 'old':
                $residualValue = 0.2;
                break;
            case 'average':
                $residualValue = 0.5;
                break;
            case 'new':
                $residualValue = 0.8;
                break;
            default:
        }

        switch ($workTime) {
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
        $simpleEstimation = ($buyValue - $residualValue) / $lifeTime / $workTime;
        return $simpleEstimation;
    }
}
