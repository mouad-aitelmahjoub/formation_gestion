<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('roleTranslater', [$this, 'roleTranslater']),
        ];
    }

    public function roleTranslater($role)
    {
        if($role == 'ROLE_ADMIN')
        {
            return '<span class="badge badge-pill badge-success">Administrateur</span>' ;
        }
        if($role == 'ROLE_AGENT')
        {
            return '<span class="badge badge-pill badge-info">Agent</span>' ;
        }
        else
        {
            return '<span class="badge badge-pill badge-warning"><i class="fas fa-exclamation-circle"></i></span>';
        }
    }
}
