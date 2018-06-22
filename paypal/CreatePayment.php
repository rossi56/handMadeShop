<?php
require_once "PayPalPayment.php";




            $success = 0;
            $msg = "Une erreur est survenue, merci de bien vouloir réessayer ultérieurement...";
            $paypal_response = [];

            $bdd = new PDO('mysql:dbname=boutique; host=localhost; charset=utf8', 'root', '');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);     
                $articles = $bdd->query("SELECT caddie.*, articles.* FROM caddie INNER JOIN articles ON caddie.id_article = articles.id ");
                $articles = $articles->fetch(PDO::FETCH_ASSOC);
            

            $payer = new PayPalPayment;
            $payer->setSandboxMode(1);
            $payer->setClientID("AZ6ZIzEGMoxHmqaZOlo021A8P4JcyGj2P6_yyGsgx2xwYlKjufkdUcYMTNqxEdwMjykpX47VelRbTkig");
            $payer->setSecret("EGvBpdVftF9p5_NEm2lbDpUcUjWw-zfL_kThxeum8lSqt9rqJe76nykJD-bcQsvLbYcdk_qJALaYl2rQ");
            
            $req = $bdd->query("SELECT sum(price_total) FROM caddie");
            $count = $req->fetch(PDO::FETCH_ASSOC);
         

            $payment_data = [
            "intent" => "sale",
            "redirect_urls" => [
                  "return_url" => "http://localhost/Projet5/Compte-utilisateur",
                  "cancel_url" => "http://localhost/Projet5/Compte-utilisateur"
            ],
            "payer" => [
                  "payment_method" => "paypal"
            ],
            "transactions" => [
                  [
                  "amount" => [
                        "total" => strval($count['sum(price_total)']+(($articles['livraisonPrice']+$count['sum(price_total)'])*0.2)+$articles['livraisonPrice']),
                        "currency" => "EUR",
                        "details" => [
                              "subtotal" =>  strval($count['sum(price_total)']),
                              "tax" => strval(($articles['livraisonPrice']+$count['sum(price_total)'])*0.2),
                              "shipping" =>  strval($articles['livraisonPrice'])
                        ]
                  ],
                  "item_list" => [
                        "items" => [
                        [
                              "sku" => $articles['id_article'],
                              "quantity" => strval($articles['quantite']),
                              "name" => $articles['titre'],
                              "price" =>strval($articles['price']),
                              "currency" => "EUR",
                             
                        ]
                        ]
                  ],
                  "description" => "Ma p'tite Boutique vous remercie pour votre achat."
                  ]
            ]
            ];
            $paypal_response = $payer->createPayment($payment_data);
            $paypal_response = json_decode($paypal_response);
            
            if (!empty($paypal_response->id)) {
            
                  
            $insert = $bdd->prepare("INSERT INTO paiements (payment_id, payment_status, payment_amount, payment_currency, payment_date) VALUES(:payment_id, :payment_status, :payment_amount, :payment_currency, NOW())");
            $insert_ok = $insert->execute(array(
                  "payment_id" => $paypal_response->id,
                  "payment_status" => $paypal_response->state,
                  "payment_amount" => $paypal_response->transactions[0]->amount->total,
                  "payment_currency" => $paypal_response->transactions[0]->amount->currency,
                  "payment_currency" => $paypal_response->transactions[0]->amount->currency,
                  ));
      
            if ($insert_ok) {
                  $success = 1;
                  $msg = "";
            }
            } else {
            $msg = "Une erreur est survenue durant la communication avec les serveurs de PayPal. Merci de bien vouloir réessayer ultérieurement.";
            }
      
            echo json_encode(["success" => $success, "msg" => $msg, "paypal_response" => $paypal_response]);
            
      

    