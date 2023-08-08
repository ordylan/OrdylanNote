<?php
echo('地标介绍生成器!! 使用-<a href="?mode=1&'.rand(0,9999).'">[生成字典1]</a>|<a href="?mode=2&'.rand(0,9999).'">[生成字典2]</a><br>');
function generateName($length) {
    $consonants = array('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z');
    $vowels = array('a', 'e', 'i', 'o', 'u');
    $name = '';
    $num_vowels = 0;
    for ($i = 0; $i < $length; $i++) {
        if ($i % 2 == 0) {
            // 偶数位随机选取一个辅音字母
            $name .= $consonants[array_rand($consonants)];
        } else {
            // 奇数位随机选取一个元音字母
            $name .= $vowels[array_rand($vowels)];
            $num_vowels++;
        }
    }
    // 如果元音字母数量小于等于1，将最后一个辅音字母变为元音字母
    if ($num_vowels <= 1) {
        for ($i = strlen($name) - 1; $i >= 0; $i--) {
            if (in_array($name[$i], $consonants)) {
                $name[$i] = $vowels[array_rand($vowels)];
                break;
            }
        }
    }

    return ucfirst($name);
}
function generatePlace() {
//$prefixes = array('New', 'Green', 'Golden', 'Crystal', 'Misty', 'Bright', 'Dark', 'Silent', 'Red', 'Blue', 'White', 'Black');
//    $prefix = $prefixes[array_rand($prefixes)];
//    $introduction1 = $prefix;
$placeee = '[{"i":"is a beautiful place surrounded by natural scenery.","l":["Mountain", "Hill", "Valley", "Plateau", "Plain", "Glacier", "Delta", "Canyon", "River", "Stream", "Lake", "Waterfall"]},{"i":"is famous for its vibrant culture and rich history.","l":["Town", "City", "Province", "State", "Country", "Governorate"]},{"i":"is a peaceful and tranquil place where people can relax.","l":["Village", "Town", "County", "Province", "Territory", "Reservation", "Parish"]},{"i":"is a bustling city full of opportunity and excitement.","l":["City", "Metropolis", "Department", "Territory", "Constituency", "Arrondissement", "Bay"]},{"i":"is renowned for its delicious food and drinks.","l":["Village", "Town", "City", "Province", "State", "Country", "Peninsula", "Bay"]},{"i":"is a popular destination for tourists from all over the world.","l":["City", "Province", "State", "Country", "Territory", "Commune"]},{"i":"is a fascinating place with many wonders to discover.","l":["Town", "City", "Province", "State", "Country", "Mountain"]},{"i":"is a place of great importance in the local community.","l":["Town", "City", "County", "Province", "State", "Country", "Parish"]},{"i":"is a modern city with cutting-edge technology.","l":["City", "Metropolis", "State", "Province", "Territory", "Department"]},{"i":"is a place of great beauty and serenity.","l":["Mountain", "Hill", "Valley", "Plateau", "Plain", "Glacier", "Delta", "Canyon", "River", "Stream", "Lake", "Waterfall"]},{"i":"is a hub of creativity and innovation.","l":["City", "Metropolis", "State", "Province", "Territory", "Department"]},{"i":"is a place of contrasts and contradictions.","l":["City", "Province", "State", "Country", "Peninsula", "Bay", "Mountain", "Valley"]},{"i":"is a land of spectacular landscapes and diverse cultures.","l":["Country", "Province", "State"]},{"i":"is known for its breathtaking natural beauty.","l":["Mountain", "Hill", "Valley", "Plateau", "Plain", "Glacier", "Delta", "Canyon", "River", "Stream", "Lake", "Waterfall"]},{"i":"is a place steeped in tradition and ancient customs.","l":["Town", "City", "Province", "State", "Country", "Parish"]},{"i":"is a cultural melting pot where old meets new.","l":["City", "Metropolis", "Province", "State", "Country", "Territory"]},{"i":"is a place where legends and myths come to life.","l":["Mountain", "Valley", "Plateau", "Plain", "River", "Lake", "Peninsula", "Waterfall"]},{"i":"is a gateway to adventure and exploration.","l":["Town", "City", "Province", "State", "Country", "Mountain", "Valley", "Plateau", "Plain", "Glacier", "Delta", "Canyon", "Peninsula", "Bay", "River", "Stream", "Lake", "Waterfall"]},{"i":"is a vibrant and dynamic city that never sleeps.","l":["City", "Metropolis", "State", "Province", "Territory", "Department"]},{"i":"is a place of mystery and intrigue.","l":["Town", "City", "Province", "State", "Country", "Mountain", "Valley", "Plateau", "Plain", "Glacier", "Delta", "Canyon", "Peninsula", "Bay", "River", "Stream", "Lake", "Waterfall"]},{"i":"is a city of contrasts, where the past and the present coexist.","l":["City", "Province", "State", "Country", "Peninsula", "Bay", "Mountain", "Valley"]},{"i":"is a land of temples, pagodas and spiritual enlightenment.","l":["Mountain", "Valley", "River"]},{"i":"is a place of endless possibilities and untapped potential.","l":["City", "Province", "State", "Country", "Mountain"]},{"i":"is a city of dreams, where anything is possible.","l":["City", "Metropolis", "State", "Province", "Territory", "Department"]},{"i":"is a jewel in the crown of the region, with its stunning landscapes and rich history.","l":["Province", "State", "Country", "Mountain", "Valley", "Plateau", "Plain", "Glacier", "Delta", "Canyon", "River", "Stream", "Lake", "Waterfall"]},{"i":"is a city of innovation, where technology and tradition combine to create a unique fusion.","l":["City", "Metropolis", "State", "Province", "Territory", "Department"]},{"i":"is a place where culture, history and natural beauty converge.","l":["Town", "City", "Province", "State", "Country", "Mountain", "Valley", "Plateau", "Plain", "Glacier", "Delta", "Canyon", "Peninsula", "Bay", "River", "Stream", "Lake", "Waterfall"]},{"i":"is a city with a rich and diverse cultural heritage.","l":["City", "Metropolis", "State", "Province", "Territory", "Department"]},{"i":"is a paradise for food lovers, with its delicious cuisine and vibrant street food scene.","l":["Town", "City", "Province", "State", "Country", "Peninsula", "Bay"]},{"i":"is a place of myth and legend, with stories and folklore that have been passed down for generations.","l":["Mountain", "Valley", "Plateau", "Plain", "River", "Lake", "Peninsula", "Waterfall"]},{"i":"is a city that never fails to surprise and delight its visitors.","l":["City", "Metropolis", "State", "Province", "Territory", "Department"]},{"i":"is a city of contrasts, where the old and the new blend seamlessly together.","l":["City", "Province", "State", "Country", "Peninsula", "Bay", "Mountain", "Valley"]},{"i":"is a place of reflection and introspection, where one can find inner peace and tranquility.","l":["Mountain", "Valley", "Plateau", "Plain", "River", "Lake"]},{"i":"is a place of exploration and discovery, with hidden gems waiting to be uncovered at every turn.","l":["Town", "City", "Province", "State", "Country", "Mountain", "Valley", "Plateau", "Plain", "Glacier", "Delta", "Canyon", "Peninsula", "Bay", "River", "Stream", "Lake", "Waterfall"]},{"i":"is a city with a strong sense of community and belonging.","l":["City", "Metropolis", "State", "Province", "Territory"]},{"i":"is a place where culture and history are intertwined and celebrated.","l":["Town", "City", "Province", "State", "Country", "Mountain", "Valley", "Plateau", "Plain", "Glacier", "Delta", "Canyon", "Peninsula", "Bay", "River", "Stream", "Lake", "Waterfall"]},{"i":"is a city that never sleeps, with something for everyone, no matter what time of day or night.","l":["City", "Metropolis", "State", "Province", "Territory", "Department"]},{"i":"is a place of natural wonder, with stunning scenery and breathtaking landscapes.","l":["Mountain", "Hill", "Valley", "Plateau", "Plain", "Glacier", "Delta", "Canyon", "River", "Stream", "Lake", "Waterfall"]},{"i":"is a place of spiritual significance, with ancient temples and holy sites scattered throughout the province.","l":["Province", "State", "Country", "Mountain", "Valley", "River"]},{"i":"is a city renowned for its world-class museums and art galleries.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a destination for outdoor adventurers, with opportunities for hiking, skiing, and more.","l":["Mountain", "Hill", "Valley", "Plateau", "Glacier", "Canyon", "Peninsula", "River", "Stream", "Lake", "Waterfall"]},{"i":"is a town steeped in history, with well-preserved buildings dating back to the early 19th century.","l":["Town", "City", "County"]},{"i":"is a coastal city with beautiful beaches and a vibrant beach culture.","l":["City", "Province", "State", "Country", "Peninsula", "Bay"]},{"i":"is a place of pilgrimage for followers of a particular religion or spiritual practice.","l":["Mountain", "Valley", "River"]},{"i":"is a city where music and the arts thrive, with a robust music scene and numerous theaters and galleries.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a university town, known for its intellectual and creative energy.","l":["Town", "City", "Province", "State"]},{"i":"is a place where wildlife abounds, with opportunities for birdwatching, safari tours, and more.","l":["Mountain", "Hill", "Valley", "Plateau", "Plain", "River", "Stream", "Lake"]},{"i":"is a city with a strong tradition of culinary excellence, with local specialties that are famous throughout the region.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a hub of industry and commerce, with a bustling port and numerous factories and warehouses.","l":["City", "Metropolis", "Province", "State", "Country", "Bay", "River"]},{"i":"is a paradise for outdoor enthusiasts, with ample opportunities for fishing, hunting, and other activities.","l":["Mountain", "Hill", "Valley", "Plateau", "Plain", "River", "Stream", "Lake"]},{"i":"is a city with a thriving nightlife, with a wide variety of bars, clubs, and entertainment options.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of innovation and entrepreneurship, with a vibrant startup culture and business-friendly environment.","l":["City", "Metropolis", "Province", "State", "Country", "Territory"]},{"i":"is a city with a rich history of architecture, with well-preserved buildings from various eras and styles.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place where the natural world and human civilization coexist in harmony.","l":["Town", "City", "Province", "State", "Country", "Mountain", "Valley", "Plateau", "Plain", "River", "Stream", "Lake"]},{"i":"is a city with a strong sports culture, with passionate fans and world-class facilities.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of pristine beauty, with untouched wilderness and breathtaking scenery.","l":["Mountain", "Hill", "Valley", "Plateau", "Glacier", "Canyon", "Peninsula", "River", "Stream", "Lake", "Waterfall"]},{"i":"is a city that celebrates diversity and inclusivity, with a thriving LGBTQ+ community and numerous cultural festivals.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of healing and rejuvenation, with its hot springs and natural spas","l":["Town", "City", "Province", "State", "Country", "Mountain", "Valley"]},{"i":"is a city with a vibrant street art scene, with colorful murals and graffiti adorning its walls.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of adventure and excitement, with opportunities for extreme sports such as rock climbing and bungee jumping.","l":["Mountain", "Canyon", "River", "Stream", "Lake", "Waterfall"]},{"i":"is a city with a rich literary history, having been the birthplace or home to many renowned writers and poets.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of spiritual renewal, with numerous meditation and yoga centers.","l":["Mountain", "Valley", "Plateau", "River"]},{"i":"is a city that takes pride in its local cuisine, with a strong farm-to-table movement and emphasis on locally sourced ingredients.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of striking contrasts, with both modern skyscrapers and ancient temples standing side by side.","l":["City", "Province", "State", "Country"]},{"i":"is a city with a strong tradition of street food, offering a wide variety of delicious and affordable snacks.","l":["City", "Province", "State", "Country"]},{"i":"is a place of natural wonders, with unique geological formations and rare wildlife.","l":["Mountain", "Valley", "Plateau", "Glacier", "Canyon", "River", "Stream", "Lake"]},{"i":"is a city with a thriving transportation system, making it easy to explore all its different neighborhoods and attractions.","l":["City", "Metropolis", "Province", "State", "Country", "Territory"]},{"i":"is a place with deep roots in local folklore, with many legends and myths associated with its landmarks and natural features.","l":["Mountain", "Valley", "Plateau", "Plain", "River", "Lake", "Peninsula", "Waterfall"]},{"i":"is a city with a strong sense of community activism and social justice, with numerous grassroots organizations working towards positive change.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of stunning natural phenomena, such as the Northern Lights or a rare total solar eclipse.","l":["Mountain", "Valley", "Plateau", "Plain", "River", "Lake"]},{"i":"is a city with a vibrant fashion and design scene, attracting visitors from all over the world for its fashion shows and design exhibitions.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of scientific discovery, with world-renowned research institutions and pioneering innovations.","l":["Town", "City", "Province", "State", "Country", "Mountain", "Valley", "Plateau", "River"]},{"i":"is a city with a rich musical heritage, having produced many influential musicians and bands.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place where luxury and opulence are the norm, with upscale shopping districts, fine dining restaurants, and lavish hotels.","l":["City", "Province", "State", "Country"]},{"i":"is a city with a strong tradition of public art, including sculptures, installations, and murals that can be found throughout its streets and parks.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of deep historical significance, with numerous museums and monuments commemorating pivotal events and figures.","l":["City", "Province", "State", "Country"]},{"i":"is a city with a thriving tech industry, with numerous startups and established companies driving innovation and economic growth.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place where the natural environment is protected and preserved, with many national parks and nature reserves.","l":["Mountain", "Valley", "Plateau", "Plain", "Glacier", "Delta", "Canyon", "River", "Stream", "Lake", "Waterfall"]},{"i":"is a city that values sustainability and green living, with numerous eco-friendly initiatives and infrastructure.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of culinary fusion, where different cuisines and cooking styles blend together to create unique and delicious dishes.","l":["City", "Province", "State", "Country"]},{"i":"is a city with a thriving theater and performing arts scene, with numerous venues showcasing plays, musicals, and other performances.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of ancient ruins and archaeological wonders, providing a glimpse into the region\'s rich historical past.","l":["Mountain", "Valley", "Plateau", "Plain", "River", "Peninsula"]},{"i":"is a city with a strong tradition of brewing and distilling, producing some of the world\'s finest beers and spirits.","l":["City", "Province", "State", "Country"]},{"i":"is a place of cultural immersion, with numerous language schools and opportunities to learn about the local customs and traditions.","l":["Town", "City", "Province", "State", "Country"]},{"i":"is a city with a thriving film industry, hosting international festivals and producing critically acclaimed works.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of reflection and remembrance, with many memorials and cemeteries honoring those who have passed.","l":["City", "Province", "State", "Country", "Mountain", "Valley", "Plateau", "River", "Stream", "Lake"]},{"i":"is a city with a thriving gaming and esports culture, attracting gamers and fans from all over the world.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of cultural exchange, with numerous exchange programs and opportunities for international students and travelers.","l":["City", "Province", "State", "Country"]},{"i":"is a city with a strong tradition of community engagement and volunteerism, with numerous opportunities to get involved and make a difference.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of architectural wonders, with iconic structures and landmarks that have become symbols of the city\'s identity.","l":["City", "Province", "State", "Country"]},{"i":"is a city with a vibrant coffee culture, with numerous cafes and roasteries serving up some of the world\'s finest brews.","l":["City", "Province", "State", "Country"]},{"i":"is a place of dynamic urban design, with innovative public spaces and pedestrian-friendly streetscapes.","l":["City", "Province", "State", "Country"]},{"i":"is a city that values education and knowledge, with numerous universities and research institutions advancing fields of study and research.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of outdoor adventure, with opportunities for hiking, camping, and wildlife viewing.","l":["Mountain", "Valley", "Plateau", "Glacier", "Canyon", "Peninsula", "River", "Stream", "Lake"]},{"i":"is a city with a diverse nightlife scene, with numerous bars, clubs, and music venues.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of rejuvenation and relaxation, with its tranquil beaches and crystal-clear waters.","l":["Beach", "Coast", "Island", "Sea"]},{"i":"is a city with a strong fashion industry, hosting international fashion weeks and producing some of the world\'s top designers.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of innovation and entrepreneurship, with a thriving startup culture and incubators fostering new ideas.","l":["City", "Province", "State", "Country"]},{"i":"is a city with a rich sports heritage, with numerous championship teams and legendary athletes.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of rural charm, with its picturesque farms and pastoral landscapes.","l":["Town", "Village", "Countryside", "Farmland", "Ranch"]},{"i":"is a city with a strong tradition of theater, hosting numerous Broadway productions and renowned performing arts institutions.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of relaxation and indulgence, with its luxurious spas and wellness centers.","l":["Town", "City", "Province", "State", "Country"]},{"i":"is a city with a vibrant street food scene, where visitors can enjoy cheap and delicious eats from food trucks and carts.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of spiritual pilgrimage, attracting devotees from around the world to its holy sites and sacred landmarks.","l":["Mountain", "Valley", "Plateau", "Plain", "River", "Peninsula"]},{"i":"is a city with a strong tradition of community theater, showcasing local talent and fostering creative expression.","l":["City", "Town", "Province", "State", "Country"]},{"i":"is a place of artistic inspiration, with stunning landscapes and breathtaking vistas that have inspired countless works of art.","l":["Mountain", "Valley", "Plateau", "Plain", "River", "Lake", "Peninsula"]},{"i":"is a city with a lively music scene, featuring concerts and performances in a wide range of genres.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of historical importance, with many landmarks and monuments commemorating pivotal events and figures in the nation\'s history.","l":["City", "Province", "State", "Country", "Mountain", "Valley", "Plateau", "River"]},{"i":"is a city with a strong tradition of public parks and green spaces, providing respite from the hustle and bustle of urban life.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of scientific wonder, with cutting-edge research facilities and discoveries that are shaping our understanding of the world.","l":["Town", "City", "Province", "State", "Country"]},{"i":"is a city with a diverse culinary scene, featuring cuisine from around the world and fusion dishes that reflect the city\'s cultural mix.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of natural beauty, with its pristine forests, sparkling lakes, and rugged mountains.","l":["Mountain", "Valley", "Plateau", "Lake", "River"]},{"i":"is a city with a strong tradition of professional sports, with championship teams in multiple leagues.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of intellectual curiosity, with museums and galleries showcasing art, history, and science.","l":["City", "Town", "Province", "State", "Country"]},{"i":"is a city with a thriving creative scene, featuring artists, writers, and performers who are pushing boundaries and breaking new ground.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of religious significance, attracting pilgrims and spiritual seekers to its sacred sites and shrines.","l":["Mountain", "Valley", "Plateau", "Plain", "River", "Peninsula"]},{"i":"is a city with a strong tradition of festivals and celebrations, with events throughout the year that showcase the city\'s culture and diversity.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of environmental conservation, with initiatives to protect its fragile ecosystems and endangered species.","l":["Mountain", "Valley", "Plateau", "Plain", "Glacier", "Delta", "Canyon", "River", "Stream", "Lake", "Waterfall"]},{"i":"is a city with a rich legacy of architecture, featuring iconic buildings and structures that are recognized around the world.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of diverse cultures, with neighborhoods and communities that reflect the city\'s multiculturalism.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a city with a strong tradition of public transit, offering a variety of options for getting around the city.","l":["City", "Metropolis", "Province", "State", "Country", "Territory"]},{"i":"is a place of transformation and self-discovery, with retreats and workshops designed to facilitate personal growth and healing.","l":["Mountain", "Valley", "Stream", "Lake"]},{"i":"is a city with a thriving wine industry, producing world-class wines and hosting wine festivals and tastings.","l":["City", "Province", "State", "Country"]},{"i":"is a place of vibrant street culture, with colorful markets and bustling shopping districts.","l":["City", "Town", "Province", "State", "Country"]},{"i":"is a city with a rich oceanic heritage, featuring museums, aquariums, and maritime history.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of architectural innovation, with cutting-edge designs and sustainable buildings that are shaping the future of urban living.","l":["City", "Province", "State", "Country"]},{"i":"is a city with a strong tradition of book culture, with numerous bookstores, literary events, and libraries.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of extreme natural beauty, with soaring peaks, glacier-fed rivers, and dramatic waterfalls.","l":["Mountain", "Valley", "Stream", "Lake", "Waterfall"]},{"i":"is a city with a thriving technology sector, attracting top talent and driving innovation in fields such as AI, robotics, and biotech.","l":["City", "Metropolis", "Province", "State", "Country"]},{"i":"is a place of culinary excellence, with Michelin-starred restaurants and culinary schools attracting foodies from around the world.","l":["City", "Province", "State", "Country"]}]';
    $placeee = json_decode($placeee,true);
    $introduction1 = generateName(rand(4,8));
    $id = rand(0,count($placeee)-1);
    $introduction2 = ' ' . $placeee[$id]["l"][rand(0,count($placeee[$id]["l"])-1)];
    //$introduction2 = ' ' . array_rand(array_flip(array('Town', 'Village', 'City', 'County', 'District', 'Province', 'State', 'Country', 'Principality', 'Shire', 'Canton', 'Department', 'Oblast', 'Territory', 'Commune', 'Reservation', 'Constituency', 'Parish', 'Arrondissement', 'Governorate', 'Mountain', 'Hill', 'Valley', 'Plateau', 'Plain', 'Glacier', 'Delta', 'Canyon', 'Peninsula', 'Bay', 'River', 'Stream', 'Lake', 'Waterfall', 'Gulf')));
    //$introduction3 = ucfirst(array_rand(array_flip(array('mountain', 'valley', 'river', 'lake', 'forest', 'beach', 'cave', 'hills', 'plateau', 'bay', 'harbor', 'port'))));
    $introduction4 = $placeee[$id]["i"];
    //$description = "$introduction1 $introduction2, also known as $introduction3, $introduction4";
    $description = "$introduction1 $introduction2, $introduction4";
    return $description;
}
if($_GET["mode"]=="1"){
for($i=0; $i<100; $i++) {
echo generatePlace() . "<br>"; 
}
}
elseif($_GET["mode"]=="2"){
for($i=0; $i<100; $i++) {
$adjectives = array('stunning', 'vibrant', 'lively', 'rugged', 'dramatic', 'pristine', 'majestic', 'idyllic', 'tranquil');
$verbs = array('explore', 'admire', 'enjoy', 'marvel at', 'experience', 'discover', 'hike through', 'swim in', 'relax by');
$prepositional_phrases = array('in the heart of nature', 'filled with unique wildlife', 'with crystal clear waters', 'that offer breathtaking views', 'rich in cultural heritage', 'waiting to be discovered', 'for a romantic getaway', 'with endless adventure opportunities', 'offering a haven for birdwatchers');
$random_adjective = $adjectives[array_rand($adjectives)];
$random_verb = $verbs[array_rand($verbs)];
$random_prepositional_phrase = $prepositional_phrases[array_rand($prepositional_phrases)];

echo generateName(rand(4,8))." ".array_rand(array_flip(array('Town', 'Village', 'City', 'County', 'District', 'Province', 'State', 'Country', 'Principality', 'Shire', 'Canton', 'Department', 'Oblast', 'Territory', 'Commune', 'Reservation', 'Constituency', 'Parish', 'Arrondissement', 'Governorate', 'Mountain', 'Hill', 'Valley', 'Plateau', 'Plain', 'Glacier', 'Delta', 'Canyon', 'Peninsula', 'Bay', 'River', 'Stream', 'Lake', 'Waterfall', 'Gulf')))."is $random_adjective and perfect for those who love to $random_verb. It's $random_prepositional_phrase.". "<br>";
}}
?>