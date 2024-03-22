<?php include 'connection_db.php'; ?>
<?php
session_start();
?>


<?php
try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $pdo->prepare("SELECT * FROM notice");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>

<?php
$msg_cmp = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cmpemail = $_POST["complainEmail"];
    $complain = $_POST["complain"];


    try {

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // echo $email;
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $stmt = $pdo->prepare("INSERT INTO complain(email,complain, status) VALUES (:email, :complain,'unsolved')");
        $stmt->bindParam(':email', $cmpemail);
        $stmt->bindParam(':complain', $complain);




        $success = $stmt->execute();


        if ($success) {
            $msg_cmp = "Complain Successfully submitted.";
        } else {
            $msg_cmp = "Complain failed.";
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./extra/css/dataTables.bootstrap5.css">
</head>

<body>
    <?php include 'header_top.php' ?>
    <?php include 'header.php' ?>
    <section class="my-5">
        <h1 class="text-center bg-info-subtle p-2">ABOUT SAFEER ACADEMY</h1>
        <section class="w-75  mx-auto" style="border: 2px solid red;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin-top:0px;background:white;" class="subpage-content cat-level-one well">
                            <div id="categoryDiv" class="subpage-body-description">
                                <h2>About Safeer Academy</h2>
                                <hr class="colorgraph">
                                <p align="justify">
                                    <strong style='background:orange;color:white;font-size:17px;'>Mission</strong>
                                    <br />To nurture a smart and innovative generation of leaders and workforce who are always guided by the Qur’an and Sunnah, and remain deeply connected to Allah, His Messenger (Peace be upon him), the righteous caliphs, and authentic scholars in their matters of life and death.
                                    <br /><br /><strong style='background:orange;color:white;font-size:17px;'>Vision</strong>
                                    <br />To provide high-quality educational opportunities and experiences to the young generations in line with our mission.
                                    <br /><br /><strong style='background:orange;color:white;font-size:17px;'>Core Academic Principles</strong>
                                    <br />Our syllabus and learning experiences are all derived from the following core principles:
                                    <br />1. Needs and evidence-based Islamic & general education
                                    <br /> 2. Our educational programmes and activities are broadly based on the British and Safeer Academy’s own curriculum
                                    <br /> 3. Islamic Upbringing- ‘Tarbiyyah’ enlightened education- a comprehensive upbringing based on knowledge of the Qur’an, Sunnah, ‘Hikmah’- the reasonable application of the methodical and empirical knowledge needed to make inner changes of the individuals, so that prophetic characters become their habits and part of their natural way of life, In-sha-Allah
                                    <br /> 4. We apply gradual constructive methods of development in our students
                                    <br /><br /><strong style='background:orange;color:white;font-size:17px;'>Main Characteristic</strong>
                                    <br />1. We are Qur’anic-prophetic Tarbiyyah centric
                                    <br />2. All our pupils are expected to be fluent in Arabic, English and (mother tongue)
                                    <br />3. All our pupils will memorise the Qur’an as much as they can
                                    <br />4. All our pupils are expected to be able to understand Qur’an, Sunnah & other Islamic Sources directly in Arabic
                                    <br /><br /><strong style='background:orange;color:white;font-size:17px;'>Our Educational Routes</strong>
                                    <br />Safeer Academy syllabus will be mainly focusing on British Curriculum (Cambridge or Edexcel). However, our pupils will be fully prepared for local job markets, civil services and public sectors as we offer other essential subjects e.g. Bengali language and literature and Bangladesh Studies.
                                    <br /><br /><strong style='background:orange;color:white;font-size:17px;'>Future Progression</strong>
                                    <br />Our curriculum has a progressive pathway for anyone planning to become a medical doctor, engineer, economist, or a professional Imam, and an Islamic scholar (Mufti, Mufassir, Muhaddith, etc) with mastery in Arabic language and literature at European Jamia Islamia, Medina University, Al- Azhar or any other higher educatiional institutes in the world.
                                    <br />Our students will continue their secondary and college studies at Safeer Academy with full-time British Curriculum as if they are studying in the UK.
                                    <br />As they will sit for IGCSE and A-Levels examinations under Edexcel or Cambridge, they will be entitled to apply for admission to any university home and abroad including European Jamia Islamia, London, Oxford, Cambridge, Harvard, MIT, Medina, Al Azher universities.

                                    <br /><br /><strong style='background:orange;color:white;font-size:17px;'>Key methods of teaching at Safeer Academy:</strong>
                                <ul>
                                    <li> We follow the mainstream British Curriculum and Safeer Curriculum for Islamic Sciences.</li>
                                    <li> Students are taught certain topics and themes, using tailored made study materials. </li>
                                    <li> We focus on developing learning and life skills through different learning experiences </li>
                                    <li> A well maintained smart classroom equipped with projector and sound system.</li>
                                    <li> We foster pupils’ autonomy by encouraging them to investigate their immediate environment to relate their textual knowledge, in order for it to become more contextual.</li>
                                    <li> We promote collaborative project based learning, where pupils are guided to make their own learning</li>
                                    <li> Students are fully taught the contents in the classrooms, leaving no need for private tuition. </li>
                                    <li> Our pupils work on their own learning projects at home with their full motivation and joy. </li>
                                    <li> Our pupils take responsibility of their behavior. Therefore, teachers do not need to even shout at them.</li>
                                </ul>

                                <br /><br /><strong style='background:orange;color:white;font-size:17px;'> How students are assessed at Safeer?</strong>
                                <ul>
                                    <li> We apply assessment for learning (AfL) in every lesson, monitoring their continuous progress in each topic and teachers have a comprehensive idea of how a child is progressing in their subjects. </li>
                                    <li> We do not scare our pupils with traditional exams. </li>
                                    <li>Pupils are assessed based on continuous progress on a daily basis and project completion. </li>
                                    `
                                </ul>
                                <br /><br /><strong style='background:orange;color:white;font-size:17px;'> What subjects are taught at Safeer?</strong>
                                <br /> British National Curriculum (BNC): English, Mathematics, Science, Bangla, Computing, Humanities, Art & Design, Design & Technology, Physical Education
                                <br /> Quranic Studies (QS): Quran, Quranic and modern Arabic, Dua and Hadith, Iman, Fiqh, Seerah, life skills


                                <br /><br /><strong style='background:orange;color:white;font-size:17px;'>Our Campus And Location</strong>
                                <br />Safeer Academy campus is located in a newly developed educational hub of Chattogram, surrounded by 6 international educational institutes including Asian Women University. It has easy access from `GEC More’ to Baizid Road; Zakir Hossain Road, Dhaka-Chattogram Road and Fouzderhat to Baizid Conneting Road are all in the close proximity of our campus.
                                <br />Situated not far from Jhawtola rail station from South and Sholoshohor Station from East, these outstanding buildings benefit from a superb naturally green location, with hillside views from the rooftop of the building and through speciaous glass-windows.
                                <br />In a prime position, our academic building brings exciting new architecture into a historic setting, creating a vibrant new destination for education, work, rest, and wide range of recreational facilities.
                                <br />For organising any big social events for the Academy or the teachers community, there is a state-of-art community centre, where Safeer Academy will hold its assemblies as well as other social events.
                                <br />You may commute to the healthy seaside of Patenga in less than 60 minutes by car.
                                <br />Being above 30 feet of Bahaddarhat Circle, our location is potentially safe from mass floodings.
                                <br />Everything you need here is on your doorstep, with plenty of places to eat and drink creating a buzzing social scene. For those wanting to take advantage of the great outdoors, there is a vast amount of open space including spacious walkways and small gardens. All of this combines to make Safeer Academy a place where our pupils will be proud to call home, In-sha-Allah.
                                <br />Our Academy building is located at Chandranagar, Polytechnical, Baizid, Chattragram, Bangladesh.
                                <br /><br /><strong style='background:orange;color:white;font-size:17px;'>Our Residential Facilities</strong>
                                <br />Safeer Academy is committed to provide the most comfortable accommodation for all our pupils for the best learning experiences at Safeer Academy.
                                <br />Each pupil will have their own single bed, wardrobe, reading table and chair. Every three students will have a shared toilet. For every twelve students, there will be a refrigerator, learning smart screen and a communal living room with comfortable sofas and chairs to relax.


                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <?php include 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="./extra/jquery/jquery-3.7.1.js"></script>
    <script src="./extra/jquery/dataTables.js"></script>
    <script src="./extra/jquery/dataTables.bootstrap5.js"></script>
    <script src="https://kit.fontawesome.com/95862cd6da.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>