<?php
// api/src/Entity/Tool.php
namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use App\Controller\ToolController;
use Symfony\Component\Routing\RouterInterface;

#[ORM\Entity]
#[ApiResource(operations: [
    new GetCollection(
        name: 'tools_by_ekipa',
        routeName: "team_tools",
        uriTemplate: '/tools-by-ekipa/{ekipa_id}',
        controller: ToolController::class,
    ),
    new Get(controller: null),
    new Post(),
    new Patch(),
    new Delete()
])]
class Tool
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier: true)]
    private ?int $tool_id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column(length: 255)]
    private ?string $mark = null;

    #[ORM\ManyToOne(targetEntity: "Team")]
    #[ORM\JoinColumn(name: "ekipa_id", referencedColumnName: "ekipa_id")]
    #[ApiProperty(example:"/api/teams/{ekipa_id}")]
    private $team;

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;
        return $this;
    }


    public function getToolId(): ?int
    {
        return $this->tool_id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(?string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getTeamUrl(RouterInterface $router): string
    {
        return $this->team->getTeamUrl($router);
    }


    public function getEkipaId(): ?int
    {
        if ($this->team) {
            return $this->team->getEkipaId();
        }

        return null;
    }
}
