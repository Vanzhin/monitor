<?php
declare(strict_types=1);


namespace App\Monitors\Domain\Aggregate\Monitor;

use App\Monitors\Domain\Aggregate\Monitor\Specification\MonitorSpecification;
use App\Monitors\Domain\Event\MonitorSavedEvent;
use App\Share\Domain\Service\UuidService;
use App\Share\Domain\Aggregate\Aggregate;


class Monitor extends Aggregate
{
    private string $uuid;
    private array $settings = [];
    private readonly string $contract;
    private string $sip_server;
    private bool $is_active;
    private string $uuid_contract;

    public function __construct(
        string                                $contract,
        string                                $sip_server,
        bool                                  $is_active,
        array                                 $settings,
        private readonly MonitorSpecification $monitorSpecification,
        ?string                               $uuid_contract = null,
    )
    {
        $this->uuid = UuidService::generate();
        $this->contract = $contract;
        $this->sip_server = $sip_server;
        $this->is_active = $is_active;
        $this->setSettings($settings);
        //todo хз, оставлю формирование $uuid_contract тут, потом выпилить
        $this->setUuidContract();
        $this->raise(new MonitorSavedEvent($this->getId()));
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getSettings(): array
    {
        return $this->settings;
    }

    public function isIsActive(): bool
    {
        return $this->is_active;
    }

    public function getUuidContract(): string
    {
        return $this->uuid_contract;
    }

    public function getContract(): string
    {
        return $this->contract;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function getSipServer(): string
    {
        return $this->sip_server;
    }

    public function setSipServer(string $sip_server): void
    {
        $this->sip_server = $sip_server;
    }

    public function setIsActive(bool $is_active): void
    {
        $this->is_active = $is_active;
    }

    public function setSettings(array $settings): void
    {
        $this->settings = $settings;
        $this->monitorSpecification->monitorSettingsSpecification->satisfy($this);
    }

    public function setUuidContract(string $uuid_contract = null): void
    {
        $this->uuid_contract = $uuid_contract ?? md5($this->sip_server . $this->contract);
        $this->monitorSpecification->monitorUuidContractUniqueSpecification->satisfy($this);
    }

    #[\Override] public function getId(): string
    {
        return $this->uuid;
    }
}