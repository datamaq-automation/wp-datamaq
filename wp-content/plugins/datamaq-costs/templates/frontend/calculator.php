<?php
/**
 * Frontend Calculator Template
 */
if (!defined('ABSPATH')) exit;
?>

<div class="dm-calculator-card">
    <div class="dm-calculator-header">
        <span class="dm-calculator-icon">
            <i class="bi bi-geo-alt-fill"></i>
        </span>
        <div class="dm-calculator-titles">
            <h3>Calculadora de Viáticos</h3>
            <p>Ingresá la dirección de tu planta para calcular el costo de visita.</p>
        </div>
    </div>

    <div class="dm-calculator-body">
        <div class="dm-input-group">
            <label for="dm-address-input">Dirección de la Planta</label>
            <div class="dm-input-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" id="dm-address-input" placeholder="Ej: Calle 123, Parque Industrial..." autocomplete="off">
            </div>
        </div>

        <div id="dm-calculator-results" class="dm-results-container" style="display: none;">
            <hr class="dm-divider">
            
            <div class="dm-result-row">
                <span>Distancia estimada:</span>
                <span id="dm-result-distance" class="dm-result-value">-- km</span>
            </div>
            
            <div class="dm-result-row dm-result-total">
                <span>Costo de Relevamiento:</span>
                <span id="dm-result-price" class="dm-result-value">$ --</span>
            </div>

            <div class="dm-bonus-notice">
                <i class="bi bi-info-circle"></i>
                <span>Este monto será <strong>bonificado</strong> al contratar la solución de automatización.</span>
            </div>
        </div>

        <div id="dm-calculator-loader" class="dm-loader" style="display: none;">
            <div class="dm-spinner"></div>
            <span>Calculando distancia técnica...</span>
        </div>

        <div id="dm-calculator-guide" class="dm-calculator-guide">
            <i class="bi bi-arrow-down-circle"></i>
            <span>Completá la dirección técnica para habilitar la contratación</span>
        </div>
    </div>
</div>
