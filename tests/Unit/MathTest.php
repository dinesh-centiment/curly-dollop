<?php

namespace Tests\Unit;

use App\Models\Math;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testSum(): void
    {
        $initial = new Math();
        $this->assertSame(3, $initial->sum(1, 2));
    }
}
