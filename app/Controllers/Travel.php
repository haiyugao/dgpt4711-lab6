<?php

namespace App\Controllers;

class Travel extends BaseController {

    public function index() {
        // connect to the model
        $places = new \App\Models\Places();
        // retrieve all the records
        $records = $places->findAll();
        
        $parser = \Config\Services::parser();
        // tell it about the substitions
        /* return $parser->setData(['records' => $records])     
          // and have it render the template with those
          ->render('placeslist'); 
         * 
         */
        
        $table = new \CodeIgniter\View\Table();
        $headings = $places->fields;
        $displayHeadings = array_slice($headings, 1, 2);
        $table->setHeading(array_map('ucfirst', $displayHeadings));
        foreach ($records as $record) {
            $nameLink = anchor("travel/showme/$record->id", $record->name);
            $table->addRow($nameLink, $record->description);
        }

        $template = [
            'table_open' => '<table cellpadding="5px">',
            'cell_start' => '<td style="border: 1px solid #dddddd;">',
            'row_alt_start' => '<tr style="background-color:#dddddd">',
        ];
        $table->setTemplate($template);

        $fields = [
            'title' => 'Travel Destinations',
            'heading' => 'Travel Destinations',
            'footer' => 'Haiyu Gao'
        ];

        // get a template parser
        
        return $parser->setData($fields)
                        ->render('templates\top') .
                $table->generate() .
                        $parser->setData($fields)
                        ->render('templates\bottom');
    }

    public function showme($id) {
        // connect to the model
        $places = new \App\Models\Places();
        // retrieve all the records  
        $record = $places->find($id);
        // get a template parser
        $parser = \Config\Services::parser();
        $table = new \CodeIgniter\View\Table();
      $headings = $places->fields;
      
      $table->addRow($record['id']);
      $table->addRow($record['name']);
      $table->addRow($record['description']);
      $table->addRow($record['link']);
      $table->addRow( "<img src=\"/image/".$record['image']."\"/>");
         $template = [
            'table_open' => '<table cellpadding="5px">',
            'cell_start' => '<td style="border: 1px solid #dddddd;">',
            'row_alt_start' => '<tr style="background-color:#dddddd">',
        ];
          $fields = [
            'title' => 'Travel Destinations',
            'heading' => 'Travel Destinations',
            'footer' => 'Haiyu Gao'
        ];
          $table->setTemplate($template);
      return $parser->setData($fields)
         ->render('templates\top') .
      $table->generate() .
      $parser->setData($fields)
         ->render('templates\bottom');
        // tell it about the substitions 
    }

}
