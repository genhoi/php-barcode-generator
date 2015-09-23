<?php

namespace Picqer\Barcode;

class BarcodeGeneratorHTML extends BarcodeGenerator
{

    /**
     * Return an HTML representation of barcode.
     *
     * @param string $code code to print
     * @param string $type type of barcode
     * @param int $widthFactor Width of a single bar element in pixels.
     * @param int $totalHeight Height of a single bar element in pixels.
     * @param int $color Foreground color for bar elements (background is transparent).
     * @return string HTML code.
     * @public
     */
    public function getBarcode($code, $type, $widthFactor = 2, $totalHeight = 30, $color = 'black')
    {

        $barcodeData = $this->getBarcodeData($code, $type);

        $html = '<div style="font-size:0;width:' . ($barcodeData['maxWidth'] * $widthFactor) . 'px;height:' . ($totalHeight) . 'px;">' . "\n";

        foreach ($barcodeData['bars'] as $bar) {
            $barWidth = round(($bar['width'] * $widthFactor), 3);
            $barHeight = round(($bar['height'] * $totalHeight / $barcodeData['maxHeight']), 3);

            if ($bar['drawBar']) {
                $html .= '<div style="float:left;background-color:' . $color . ';width:' . $barWidth . 'px;height:' . $barHeight . 'px;">&nbsp;</div>' . "\n";
            } else {
                $html .= '<div style="float:left;width:' . $barWidth . 'px;height:' . $barHeight . 'px;">&nbsp;</div>' . "\n";
            }
        }

        $html .= '</div>' . "\n";

        return $html;
    }
}
