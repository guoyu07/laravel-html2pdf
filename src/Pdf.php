<?php

namespace NahidulHasan\Html2pdf;

use Illuminate\Http\Response;


/**
 * Laravel htm2pdf: convert html into pdf
 *
 * @package laravel-html2pdf
 * @author Nahidul Hasan <nahidul.cse@gmail.com>
 */
class Pdf
{

    /**
     * Convert html into pdf
     *
     * @param $input
     * @return bool|string
     */
    public function generatePdf($input)
    {
        file_put_contents('page.html', $input);

        shell_exec('xvfb-run wkhtmltopdf page.html page.pdf');

        return file_get_contents('page.pdf');

    }


    /**
     * Make the PDF downloadable by the user
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public  function download()
    {
        $file = public_path(). "/page.pdf";

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>  'attachment; filename="'.'filename.pdf'.'"',
        ];

        return response()->download($file, 'filename.pdf', $headers);
    }


    /**
     * Make the PDF downloadable by the user
     *
     * @param string $input
     * @return \Illuminate\Http\Response
     */
    /*public function download($input = 'document.pdf' ){

        $output = $this->generatePdf($input);

        return new Response($output, 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>  'attachment; filename="'.$input.'"'
        ));
    }*/

}
