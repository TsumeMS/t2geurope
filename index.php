<?php
$message = '';
$formMessage = str_split($_POST['message'] ?? '');
$codeTable = [
    'code' => ['!', ')', '"', '(', '£', '*', '%', '&', '>', '<', '@', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o'],
    'letters' => ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z']
];
if(isset($_POST['action']) && $_POST['action'] === 'encode') {
    $message = encode($codeTable, $formMessage);
}
if(isset($_POST['action']) && $_POST['action'] === 'decode') {
    $message = decode($codeTable, $formMessage);
}
function encode(array $code, array $string): string {
    return implode('', replaceLetter($code['letters'], $code['code'], $string));
}

function decode(array $code, array $string): string {
    return implode('', replaceLetter($code['code'], $code['letters'], $string));
}

function replaceLetter(array $search, array $replace, array $toChange): array {
    $replaced = [];
    foreach ($toChange as $letter) {
        $index = array_search($letter, $search);
        if($index !== false) {
            $replaced[] = $replace[$index];
        } else {
            $replaced[] = $letter;
        }
    }
    return $replaced;
}
?>

<!doctype html>
<html lang="pl">
<head>
    <title>Code Braker by Michał Stój</title>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <style rel="stylesheet">
        html, body{
            margin: 0;
            padding: 0;
            background-color: #0f0f0f;
            display: flex;
            box-sizing: border-box;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: #f0f0f0;
            width: 100%;
            height: 100vh;
            font-family: "Roboto", serif;
        }
        h2{
            font-size: 36px;
            line-height: 64px;
            margin-bottom: 20px;
        }
        .row{
            padding: 15px 10px;
            display: flex;
            justify-content: space-between;
            width: 600px;
        }
        .row label{
            width: 150px;
            font-size: 20px;
            padding: 5px 0;
        }
        .row input{
            width: 100%;
            font-size: 18px;
            padding: 5px 10px;
            border: 0;
            border-bottom: 1px solid #f0f0f0;
            background-color: #0f0f0f;
            color: #f0f0f0;
        }
        .row input:focus{
            outline: none;
        }
        .row button{
            padding: 10px 15px;
            background-color: #0f0f0f;
            color: #f0f0f0;
            border: 2px solid #f0f0f0;
            font-size: 20px;
            line-height: 32px;
            cursor: pointer;
            transition: .5s linear;
        }
        .row button:hover{
            background-color: #f0f0f0;
            color: #0f0f0f;
            border-color: #a5a5a5;
        }
        .row.column{
            flex-direction: column;
            justify-content: flex-start;
        }
        .row.column p, .row.column label{
            width: 100%;
        }
        .row p.message{
            color: #fafa33;
        }
        .row p.result{
            color: #33fa33;
        }
        footer{
            position: fixed;
            bottom: 0;
            padding-bottom: 15px;
            color: #a5a5a5;
        }
    </style>
</head>
<body>
    <h2>Code Braker</h2>
    <form action="/" method="post">
        <div class="row">
            <label>Wiadomość:</label>
            <input type="text" name="message" required value="<?php echo htmlspecialchars($_POST['message']) ?? '' ?>">
        </div>
        <div class="row">
            <button type="submit" name="action" value="encode">Zakoduj</button>
            <button type="submit" name="action" value="decode">Dekoduj</button>
        </div>
    </form>
    <?php if (!empty($message)) : ?>
    <div class="row column">
        <label>Twoja wiadomość:</label>
        <p class="message"><?php echo implode('', $formMessage) ?></p>
        <label>
            Została <?php echo ($_POST['action'] === 'encode') ? 'zakodowana' : 'odkodowana' ?> i brzmi:
        </label>
        <p class="result"><?php echo $message ?></p>
    </div>
    <?php endif; ?>
    <footer>
        Realizacja Michał Stój
    </footer>
</body>
</html>
