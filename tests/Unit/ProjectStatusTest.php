<?php

namespace Tests\Unit;

use App\Models\Project;
use PHPUnit\Framework\TestCase;

class ProjectStatusTest extends TestCase
{
    public function test_known_status_maps_to_mongolian_label(): void
    {
        $project = new Project(['status' => 'open_for_proposals']);

        $this->assertSame('Санал авч буй', $project->status_label);
    }

    public function test_unknown_status_falls_back_to_raw_value(): void
    {
        $project = new Project(['status' => 'custom_state']);

        $this->assertSame('custom_state', $project->status_label);
    }
}
