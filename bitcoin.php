<?php
// Execute the bitcoin.py script and capture its output
$bitcoin_output = shell_exec('python3 bitcoin.py');

// Display the output
echo "<pre>$bitcoin_output</pre>";
?>