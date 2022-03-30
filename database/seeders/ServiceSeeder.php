<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::insert([
            [
                'id'=>1,
                'title'=>'Custom Cake',
                'slug'=>'custom-cake',
                'description'=>'<p>All you wanted to know about ordering custom cakes (Theme cakes/Party cakes/Shape cakes/Designer cakes/Fondant cakes).</p>
                <p>Make Your Cake according to your theme. We make cakes for Birthdays, Weddings, Bridal Showers, Anniversaries and all the occasions.
                 Fill out the form and order online. We also try to accommodate any dietary needs upon request, eventually hoping to offer more healthier options as we grow.</p>
                 <p>From delicious custom-made cakes and other sweet treats, you can always rely on Bakes and and Cakes to be your go-to! Taking the bakery to you with quality dessert catering, you can always count on timely and convenient deliveries and services that are catered to your needs. 
                We are more than happy to accommodate businesses and other large parties! To order your cake or desserts, please contact Bakes and Cakes today!</p>
                <p><br></p><p><strong>How are the customized cakes made?</strong></p>
                <p>Your choice of cake is first layered with buttercream or freshly whipped cream on the inside and then covered and designed with fondant, buttercream or fresh whipped cream or chocolate ganache externally (depending on the flavor you choose). The toppers/designs on the covered cakes are made with fondant.</p>
                <br><br><p><strong>What is fondant?</strong></p>
                <p>Fondant icing, also commonly referred to simply as fondant, is an edible icing used to decorate or sculpt cakes and pastries. It is dough made out of sugar that is rolled out into sheets to cover the cakes or molded to create figures and other cake toppers. Please note that fondant is 100% edible, however it has sugary dough like taste. If you do not like this taste, you can peel it off after cutting the cake and before distributing to your guests.</p>
                <p><strong>Are the numbers, figures and flowers on the cake edible?</strong></p>
                <p>Yes. Everything on the cake is edible. However, for certain themed cakes, we use readymade non-edible toppers, this will be discussed with you when placing the order. Also, if there are huge toppers on your cake, look below to ensure that there are no wooden dowels (thin cylindrical wooden rods like toothpicks) for supporting the toppers.</p>',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'id'=>2,
                'title'=>'Free Fast Home Delivery',
                'slug'=>'free-fast-home-delivery',                
                'description'=>'
                <p>Our standard delivery time is 45 minutes. However delivery can take up to 75 minutes during busy hours or our mega event days.&nbsp;Orders are processed for delivery after confirmation from the customer.</p><ul>
                <li>Free Shipping on all orders over the value of Rs. 800.</li>
                <li>We charge Rs. 50 on all orders under the value of Rs. 800.</li>
                <li>Our standard delivery time is 45 minutes. However delivery can take up to 75 minutes during busy hours or our mega event days.</li>
                <li>Orders are processed for delivery after confirmation from the customer.</li>
                <li>Customer may be contacted for payment information on order confirmation. In case of online payment, verification may take a few minutes.</li></ul>
                <p><br></p>
                <p>Our standard delivery time is 45 minutes. However delivery can take up to 75 minutes during busy hours or our mega event days.&nbsp;Orders are processed for delivery after confirmation from the customer. Our standard delivery time is 45 minutes. However delivery can take up to 75 minutes during busy hours or our mega event days.&nbsp;Orders are processed for delivery after confirmation from the customer.</p>',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'id'=>3,
                'title'=>'Cancellation & Returns',
                'slug'=>'cancelation-returns',
                'description'=>'
                <p>We take pride in the quality and range of cakes we bring to you. We also guarantee the quality of our cakes. You must inspect the order and notify us promptly in writing or by phoning our call centre for any dissatisfaction with your order. We will promptly and fully refund the price that do not meet with your reasonable satisfaction or arrange for the delivery of replacement.</p>
                <p>We ensure that all our cakes are delivered fresh (baked a couple of hours before delivery) and in good shape when it reaches your premises. Should the cake be smudged or crushed during delivery, we will be happy to give you a refund.</p>
                <p>Your order can be cancelled as long as you give us sufficient notice of at least 4 hours prior to the delivery time.</p>
                <p>Please call our customer service on 888-0-233-233 or email us at bakesandcakes@gmail.com&nbsp; if you wish to cancel or return your order.</p>',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id'=>4,
                'title'=>'24X7 service',
                'slug'=>'24x7-service',
                'description'=>'We are providing 24x7 services our customer. Placing an order was very simple and the cake will be delivered in time',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);

           Service::all()->map(function ($services) {
            $services->addMedia(public_path('demo_images/font-banner/banner-03.jpg'))->preservingOriginal()->toMediaCollection('image');

        });
    }
    }
