<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivacyAndPolicySeeder extends Seeder
{

    public function run()
    {
        DB::table('privacy_and_policies')->insert(
            [
                'id' => 1,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tellus ipsum, feugiat et lobortis eu, molestie quis erat. Nullam sit amet semper turpis. Sed orci augue, tristique quis nisi vitae, sagittis tempor ligula. In blandit scelerisque placerat. Cras lacinia orci neque, at viverra quam hendrerit vel. Fusce tincidunt lectus ac augue convallis egestas. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras commodo sit amet tortor nec facilisis. Curabitur dui sem, dignissim vel tortor eget, faucibus aliquam lectus. Praesent orci sapien, maximus ac tempor fringilla, maximus posuere lorem. Proin blandit velit dignissim odio blandit, sit amet convallis leo ultricies. Etiam volutpat velit ac sem pretium tempor. Vestibulum consectetur sapien nisl, eu vehicula nisi ornare vitae. Etiam tristique massa a lacus ultrices, luctus facilisis diam ultrices.

                Curabitur quis consequat quam, in accumsan massa. Sed faucibus at massa vitae dapibus. Quisque gravida, erat at placerat interdum, felis libero viverra lorem, in convallis leo lectus non justo. Praesent pulvinar diam vitae felis ultrices sodales in vitae ex. Fusce eleifend diam vitae sodales auctor. Ut finibus diam vel blandit tempus. Integer congue erat consectetur, tincidunt felis sed, ultrices ante. Phasellus semper ut nunc suscipit posuere.

                In erat quam, maximus ut accumsan a, condimentum eu tortor. Praesent varius neque commodo ante pulvinar facilisis. Quisque eros ante, pharetra ut nulla at, efficitur varius diam. Donec hendrerit congue eros volutpat fermentum. Sed laoreet aliquet massa, ac iaculis sapien posuere vitae. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris ut dui quis lacus fermentum euismod. Aliquam in diam non massa consequat lobortis sit amet at velit. Praesent gravida, ipsum non condimentum aliquet, nisi orci porta nisl, in fringilla ex nisl non augue. Vivamus hendrerit ante lacus, ultricies ornare massa euismod sit amet. Duis et velit euismod, ultricies justo ac, sollicitudin leo.

                In ut leo nisl. Suspendisse potenti. Fusce non lobortis erat. Pellentesque sagittis felis sit amet quam tincidunt imperdiet. Sed pharetra egestas tellus, id elementum arcu dapibus ac. Aliquam vitae leo tempus arcu venenatis molestie ut quis est. Nunc nec pretium tortor. Donec euismod ex purus, sit amet faucibus enim luctus at. Phasellus vitae mauris ac orci iaculis porttitor quis sit amet ligula. Etiam aliquet lorem tellus, sed aliquet metus porta eget. Aenean pulvinar suscipit erat, at dictum justo ullamcorper eget.

                Vivamus a ipsum vel erat pellentesque imperdiet. Quisque sed vehicula nisl, a molestie turpis. Proin maximus suscipit justo, sit amet vehicula nisi placerat eu. Praesent rutrum mauris tempus ex fringilla, nec fermentum urna tincidunt. Curabitur sit amet leo nisl. In est tellus, sagittis sed eleifend ut, vulputate sed est. Ut lacinia, massa ullamcorper venenatis fringilla, nunc turpis pellentesque lectus, bibendum ullamcorper nulla sem vel mi. Mauris libero odio, dictum eu fermentum porta, aliquet eget urna.

                Mauris nunc lacus, vestibulum ut sodales nec, ullamcorper ut magna. Sed sagittis ut risus eget tempor. Etiam gravida aliquet sapien, eget egestas purus dignissim pretium. Fusce quis libero sed metus consequat tempus non quis sem. Nullam eu pellentesque quam. Ut mattis ullamcorper augue sed blandit. Maecenas aliquet pretium augue ac sodales. Quisque eu leo id dui auctor eleifend. Vestibulum ultrices sagittis vestibulum. Curabitur placerat nisl quis libero convallis dictum.

                Maecenas lobortis varius odio. Duis ipsum nibh, ultrices id venenatis consectetur, tristique fringilla quam. In feugiat mollis ipsum viverra lobortis. Morbi ut erat sed turpis porttitor semper vel eu nisl. Sed aliquet rutrum eros, at pellentesque ligula lobortis nec. Nam at augue nec urna consectetur faucibus vitae eget dui. Integer a felis quam. Etiam id auctor mauris. Mauris rutrum ex sed dignissim blandit. Cras auctor est in libero dapibus, nec semper ex porttitor. Vestibulum vulputate, libero nec molestie ultricies, ex augue fermentum lacus, ac pellentesque mauris augue eu dolor. Mauris tincidunt velit in sagittis egestas. Nunc nec elit interdum, aliquam nibh non, tristique augue.',

                'created_at'=> now(),
                'updated_at'=> now(),
           ]
        );
    }
}
