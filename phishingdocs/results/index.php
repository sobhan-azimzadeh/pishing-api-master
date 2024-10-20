<HTML>

<HEAD>
  <link rel="stylesheet" href="../../main.css">
  <link rel="stylesheet" href="../../w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <TITLE>PhishAPI</TITLE>
  <link rel="apple-touch-icon" sizes="57x57" href="https://avatars.githubusercontent.com/u/165959665?v=4">
  <link rel="apple-touch-icon" sizes="60x60" href="https://avatars.githubusercontent.com/u/165959665?v=4">
  <link rel="apple-touch-icon" sizes="72x72" href="https://avatars.githubusercontent.com/u/165959665?v=4">
  <link rel="apple-touch-icon" sizes="76x76" href="https://avatars.githubusercontent.com/u/165959665?v=4">
  <link rel="apple-touch-icon" sizes="114x114" href="https://avatars.githubusercontent.com/u/165959665?v=4">
  <link rel="apple-touch-icon" sizes="120x120" href="https://avatars.githubusercontent.com/u/165959665?v=4">
  <link rel="apple-touch-icon" sizes="144x144" href="https://avatars.githubusercontent.com/u/165959665?v=4">
  <link rel="apple-touch-icon" sizes="152x152" href="https://avatars.githubusercontent.com/u/165959665?v=4">
  <link rel="apple-touch-icon" sizes="180x180" href="https://avatars.githubusercontent.com/u/165959665?v=4">
  <link rel="icon" type="image/png" sizes="192x192" href="https://avatars.githubusercontent.com/u/165959665?v=4">
  <link rel="icon" type="image/png" sizes="32x32" href="https://avatars.githubusercontent.com/u/165959665?v=4">
  <link rel="icon" type="image/png" sizes="96x96" href="https://avatars.githubusercontent.com/u/165959665?v=4">
  <link rel="icon" type="image/png" sizes="16x16" href="https://avatars.githubusercontent.com/u/165959665?v=4">
  <link rel="manifest" href="../images/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="https://avatars.githubusercontent.com/u/165959665?v=4">
  <meta name="theme-color" content="#ffffff">
</HEAD>

<BODY>
  <FORM ACTION="../../index.php" METHOD="GET">
    <div class="w3-dropdown-hover w3-right">
      <button class="w3-button w3-phishapi"><i class="fa fa-home fa-2x" aria-hidden="true" style="color: black;"></i> Home</button>
      <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
        <a href="../../index.php?fakesite=1" class="w3-bar-item w3-button"><i class="fa fa-user fa-1x" aria-hidden="true" style="color: black;"></i> Fake Portal</a>
        <a href="../../phishingdocs/" class="w3-bar-item w3-button"><i class="fa fa-file-text fa-1x" aria-hidden="true" style="color: black;"></i> Weaponized Documents</a>
        <a href="../../campaigns" class="w3-bar-item w3-button"><i class="fa fa-envelope fa-1x" aria-hidden="true" style="color: black;"></i> Email Campaigns</a>
        <a href="https://curtbraz.blogspot.com/2018/10/phishapi-tool-rapid-deployment-of-fake.html" class="w3-bar-item w3-button" target="_blank"><i class="fa fa-question-circle fa-1x" aria-hidden="true" style="color: black;"></i> Help / About</a>
      </div>
    </div>
  </FORM><br><br>
  <CENTER>
    <?php

    // Read Database Connection Variables
    require_once '../../config.php';

    $dbname = "phishingdocs";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    ?>


    <?php

    // Show Credentails for the Selected Project
    if (isset($_REQUEST['UUID'])) {
      $UUID = $_REQUEST['UUID'];

      $UUID = filter_var($UUID, FILTER_SANITIZE_SPECIAL_CHARS);
      $UUID = mysqli_real_escape_string($conn, $UUID);

      $sql = "Call GetUUIDRecord('$UUID');";
      $result = $conn->query($sql);

    ?>
      <h2>
        <FONT COLOR="#FFFFFF">Received Requests</FONT>
      </h2>
      <TABLE BORDER=1>
        <TR>
          <TH>Date/Time</TH>
          <TH>IP</TH>
          <TH>Target</TH>
          <TH>Org</TH>
          <TH style="word-wrap: break-word;
max-width: 150px;">Hash</TH>
          <TH>UserAgent</TH>
          <TH>User</TH>
          <TH>Pass</TH>
        </TR>
      <?php
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        //$pw = $row["pass"];
        echo "<tr><td>" . $row["Datetime"] . "</td><td>" . $row["IP"] . "</td><td>" . $row["Target"] . "</td><td>" . $row["Org"] . "</td><td>" . $row["NTLMv2"] . "</td><td>" . $row["UA"] . "</td><td>" . $row['User'] . "</td><td>" . base64_decode($row['Pass']) . "</td></tr>";
      }

      printf($conn->error);



      $conn->close();
    }
      ?>
      </TABLE>
  </CENTER>
</BODY>

</HTML>