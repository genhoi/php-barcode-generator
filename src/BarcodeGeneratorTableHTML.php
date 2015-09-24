<?php
/**
 * @author Glazyrin Evgeniy <gev@htc-cs.ru>
 * Date: 24.09.2015
 * Time: 9:56
 */

namespace Picqer\Barcode;


class BarcodeGeneratorTableHTML extends BarcodeGenerator
{

    /**
     * Return an table HTML representation of barcode.
     *
     * @param string $code code to print
     * @param string $type type of barcode
     * @param int $widthFactor Width of a single bar element in pixels.
     * @param int $totalHeight Height of a single bar element in pixels.
     * @param int|string $color Foreground color for bar elements (background is transparent).
     * @return string HTML code.
     * @public
     */
    public function getBarcode($code, $type, $widthFactor = 2, $totalHeight = 30, $color = 'black')
    {

        $barcodeData = $this->getBarcodeData($code, $type);

        $html = '<table
            border="0"
            cellpadding="0"
            cellspacing="0"
            style="table-layout:fixed; border-spacing:0px;"
            width=' . ($barcodeData['maxWidth'] * $widthFactor).'>
            <tr>';

        foreach ($barcodeData['bars'] as $bar) {
            $barWidth = round(($bar['width'] * $widthFactor), 3);
            $barHeight = round(($bar['height'] * $totalHeight / $barcodeData['maxHeight']), 3);

            if ($bar['drawBar']) {
                $html .= $this->getColorTd($barWidth, $barHeight, $color);
            } else {
                $html .= $this->getTransparentTd($barWidth, $barHeight);
            }
        }

        $html .= '</tr></table>';

        return $html;
    }

    protected function getColorTd($width, $height, $color)
    {
        return "<td style='border-right:{$width}px solid {$color}; border-spacing:0px;' height='$height'></td>";
    }

    protected function getTransparentTd($width, $height)
    {
        return "<td style='border-right:{$width}px solid #fffff; border-spacing:0px;' height='$height'></td>";
    }

}