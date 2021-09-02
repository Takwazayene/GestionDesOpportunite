<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Opportunite;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf as Snappy;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;


class OpportuniteController extends AbstractController
{
    /**
     * @Route("/opportunite", name="opportunite")
     */
    public function index(): Response
    {
        return $this->render('opportunite/index.html.twig', [
            'controller_name' => 'OpportuniteController',
        ]);
    }


    public function createOpp(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $opportunite = new Opportunite();
        $opportunite->setCommercial('Keyboard');
        $opportunite->setPays(1999);
        $opportunite->setTerritoire('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($opportunite);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$opportunite->getId());
    }


    public function list(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Opportunite::class);
        $opportunite = $repository->findAll();


        if ($request->isMethod("POST")) {
            $status = $request->get("status"); //1
           

             $opportunite = $this->getDoctrine()->getRepository(Opportunite::class)->findBy(array( 'status' => $status));
        

        }




        return $this->render('opportunite/index.html.twig', array(
            'opportunites' => $opportunite,
        ));
    }




  /*  public function pdf()
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

      
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('opportunite/mypdf.html.twig', [
            'title' => "Welcome to our PDF Test"
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    } */


  /*  public function pdf(Snappy $knpSnappyPdf)
    {
        $html = $this->renderView('opportunite/mypdf.html.twig', [
            'title'  => 'title'
        ]);

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            'file.pdf'
        );
    }*/

 /*   public function onPostCreated(PostCreatedEvent $event): void
    {

        $html = $this->twig->render('email/post-pdf.html.twig', [
            'post' => $post,
        ]);

        $this->pdf->setTimeout(120);
        $this->pdf->setOption('enable-local-file-access', true);

        $pdf = $this->pdf->getOutputFromHtml($html);

        $subject = 'Subject';

        $email = (new TemplatedEmail())
            ->from('sender-email')
            ->to('to-email')
            ->subject('subject')
            ->attach($pdf, sprintf('new-%s.pdf', date('Y-m-d')))
        ;

        $this->mailer->send($email);
    } */


  /* public function pdf()
    {
        $snappy = $this->get('knp_snappy.pdf');
        $title='pdf';
      

        $html = $this->render('opportunite/mypdf.html.twig', array(
                'title' => $title,
            ));
           
        $filename= 'pdf';
        return new PdfResponse(
            $snappy->getOutputFromHtml($html), $filename
        );


      
    }*/


    
    public function pdf(\Knp\Snappy\Pdf $snappy,Request $request)
    {
        
        $id = $request->get("id"); //1

        

        $repository = $this->getDoctrine()->getRepository(Opportunite::class);
         $opportunite = $repository->find($id);

        $html = $this->renderView('opportunite/mypdf.html.twig', [
            'title' => 'Rapport', 'id'=> $id, 'commercial'=> $opportunite->getcommercial(),'pays'=>$opportunite->getPays() ,
            'territoire'=>$opportunite->getTerritoire() ,'client'=>$opportunite->getClient() ,'etape_transaction'=>$opportunite->getEtape_transaction() ,
            'confiance'=>$opportunite->getConfiance() ,'departement'=>$opportunite->getDepartement() ,'date_soumission'=>$opportunite->getDate_Soumission() ,
            'date_attribution'=>$opportunite->getDate_Attribution() , 'val_total'=>$opportunite->getVal_total() , 'val_nette'=>$opportunite->getVal_nette() ,
            'status'=>$opportunite->getStatus() , 
        ] );

        $filename = 'rapport';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }



    public function stat(){
        $pieChart= new PieChart();
        $repository = $this->getDoctrine()->getRepository(Opportunite::class);
        $opportunite = $repository->findAll();
       
        $totalcapacité=0;
        foreach($opportunite as $stade) {
            $totalcapacité=3;
        }
        $data= array();
        $stat=['Stade', 'capaciteStade'];
        $nb=0;
        array_push($data,$stat);
        foreach($opportunite as $stade) {
            $stat=array();
            array_push($stat,$stade->getCommercial(),(($stade->getVal_Total()) *100)/$totalcapacité);
            $nb=($stade->getVal_Total() *100)/$totalcapacité;
            $stat=[$stade->getCommercial(),$nb];
            array_push($data,$stat);
        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Pourcentages des opportunite par valeur nette
        ');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('opportunite/stat.html.twig', array('piechart' =>
            $pieChart));
    }
  
}
