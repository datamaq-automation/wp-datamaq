<?php
namespace DataMaq\Tests\Unit;

use PHPUnit\Framework\TestCase;
use DataMaq\Domain\Shared\Validation\ContentValidator;
use DataMaq\Domain\Shared\Exceptions\ValidationException;

class ContentValidatorTest extends TestCase {
    
    public function test_validate_success_when_all_sections_present(): void {
        $data = [
            'hero' => ['title' => 'Bienvenido a DataMaq'],
            'brand' => ['name' => 'DataMaq'],
            'services' => [['name' => 'Mantenimiento']]
        ];

        ContentValidator::validate($data);
        $this->assertTrue(true); // Si no lanza excepción, pasa
    }

    public function test_validate_throws_exception_on_missing_section(): void {
        $data = [
            'hero' => ['title' => 'Bienvenido'],
            'brand' => ['name' => 'DataMaq']
            // Faltan services
        ];

        $this->expectException(ValidationException::class);
        ContentValidator::validate($data);
    }

    public function test_validate_throws_exception_on_empty_hero_title(): void {
        $data = [
            'hero' => ['title' => ''],
            'brand' => ['name' => 'DataMaq'],
            'services' => []
        ];

        $this->expectException(ValidationException::class);
        ContentValidator::validate($data);
    }
}
