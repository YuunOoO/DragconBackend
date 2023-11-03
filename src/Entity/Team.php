<?php
// api/src/Entity/team.php
namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

#[ORM\Entity]
#[ApiResource]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier: true)]
    private ?int $ekipa_id = null;

    #[ORM\Column]
    private ?int $users_count = null;

    #[ORM\Column]
    private $name;

    public function getEkipaId(): ?int
    {
        return $this->ekipa_id;
    }

    public function getUsersCount(): ?int
    {
        return $this->users_count;
    }

    public function setUsersCount(int $users_count): self
    {
        $this->users_count = $users_count;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTeamUrl(RouterInterface $router): string
    {
        return $router->generate('team_show', ['id' => $this->ekipa_id], UrlGeneratorInterface::ABSOLUTE_URL);
    }
}
