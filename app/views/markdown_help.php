<?php
//app/views/markdown_help.php
include 'header.php';
?>
<h1>How to Format Notes & References (Markdown Guide)</h1>

<p>On EpyWiki, you can format your notes and add clickable references using <strong>Markdown</strong>. It’s simple and safe.</p>

<h2>1. Links (References)</h2>
<p>Format: <code>[Link Text](https://example.com)</code></p>
<p>Example in the notes field:</p>
<pre><code>[WHO Malaria Report](https://www.who.int/malaria)</code></pre>
<p>Will display as:</p>
<a href="https://www.who.int/malaria" target="_blank">WHO Malaria Report</a>

<h2>2. Bold & Italic</h2>
<ul>
    <li><strong>Bold</strong>: <code>**bold text**</code></li>
    <li><em>Italic</em>: <code>*italic text*</code></li>
</ul>

<h2>3. Lists</h2>
<p>Use dashes (-) or numbers:</p>
<pre>
- Malaria
- Cholera

1. First item
2. Second item
</pre>

<h2>4. Combining Text & Links</h2>
<p>You can mix text and links:</p>
<pre>
Cases reported in [Kenya Ministry of Health](https://www.health.go.ke) data.
</pre>

<h2>5. Quick Tips</h2>
<ul>
    <li>Always use full URLs starting with <code>http://</code> or <code>https://</code></li>
    <li>Separate references with a new line or a list</li>
    <li>You don’t need to know HTML — just follow the examples</li>
</ul>

<hr>
<p><a href="?page=home">← Back to Home</a></p>
