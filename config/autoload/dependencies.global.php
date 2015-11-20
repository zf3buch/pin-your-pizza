<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

return [
    'dependencies' => [
        'factories' => [
            Application\Action\HomePageAction::class =>
                Application\Action\HomePageFactory::class,
            Application\Action\ShowPizzaAction::class =>
                Application\Action\ShowPizzaFactory::class,
            Application\Action\HandleVoteAction::class =>
                Application\Action\HandleVoteFactory::class,
            Application\Action\HandleCommentAction::class =>
                Application\Action\HandleCommentFactory::class,

            Application\Model\Service\PizzaServiceInterface::class =>
                Application\Model\Service\StaticPizzaServiceFactory::class,

            Zend\Expressive\Application::class =>
                Zend\Expressive\Container\ApplicationFactory::class,
        ]
    ]
];
