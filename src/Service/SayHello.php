<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\UrlHelper;
use Symfony\Component\String\Slugger\SluggerInterface;

class SayHello {

//    public function __construct(private SluggerInterface $slugger, private string $email ,private $helper)
//    {
//    }

    private $slugger;
    private $email;
    private $helper;

    public function __construct(SluggerInterface $slugger,string $email , $helper)
    {
        $this->slugger = $slugger;
        $this->email = $email;
        $this->helper = $helper;
    }

    public function send()
    {
        dump($this->email);
        dump($this->helper->getAbsoluteUrl('hjgjhg'));
        dd($this->slugger->slug('hello World'));
    }

}