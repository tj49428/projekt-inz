<?php
namespace App\Controller;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
use App\Exception\NotFoundException;
use App\Model\Aquarium;
use App\Model\Animal;
use App\Model\Activity;
use App\Service\Router;
use App\Service\Templating;

class AquariumController
{
    public function indexAction(Templating $templating, Router $router): ?string
    {
        $aquariums = Aquarium::findAquariumsOwnedByUser($_SESSION['user_id']);
        $html = $templating->render('aquarium/index.html.php', [
            'aquariums' => $aquariums,
            'router' => $router,
        ]);
        return $html;
    }

    public function createAction(?array $requestAquarium, Templating $templating, Router $router): ?string
    {
        if ($requestAquarium) {
            $aquarium = Aquarium::fromArray($requestAquarium);
            // @todo missing validation
            $aquarium->save();

            $path = $router->generatePath('aquarium-index');
            $router->redirect($path);
            return null;
        } else {
            $aquarium = new Aquarium();
        }

        $html = $templating->render('aquarium/create.html.php', [
            'aquarium' => $aquarium,
            'router' => $router,
        ]);
        return $html;
    }

    public function editAction(int $aquarium_id, ?array $requestAquarium, Templating $templating, Router $router): ?string
    {
        $aquarium = Aquarium::find($aquarium_id);
        if (! $aquarium) {
            throw new NotFoundException("Missing aquarium with id $aquarium_id");
        }

        if ($requestAquarium) {
            // @todo missing validation
            $aquarium->fill($requestAquarium);
            $aquarium->save();

            $path = $router->generatePath('aquarium-index');
            $router->redirect($path);
            return null;
        }

        $html = $templating->render('aquarium/edit.html.php', [
            'aquarium' => $aquarium,
            'router' => $router,
        ]);
        return $html;
    }

    public function showAction(int $aquarium_id, Templating $templating, Router $router): ?string
    {
        $aquarium = Aquarium::find($aquarium_id);
        $animals= Animal::findAllInAquarium($aquarium_id);
        $activities = Activity::findAllAssignedToAquarium($aquarium_id);

        if (! $aquarium) {
            throw new NotFoundException("Missing aquarium with id $aquarium_id");
        }

        $html = $templating->render('aquarium/show.html.php', [
            'aquarium' => $aquarium,
            'animals' => $animals,
            'activities' => $activities,
            'router' => $router,
        ]);
        return $html;
    }

    public function deleteAction(int $aquarium_id, Router $router): ?string
    {
        $aquarium = Aquarium::find($aquarium_id);
        if (! $aquarium) {
            throw new NotFoundException("Missing aquarium with id $aquarium_id");
        }

        $aquarium->delete();
        $path = $router->generatePath('aquarium-index');
        $router->redirect($path);
        return null;
    }
}
