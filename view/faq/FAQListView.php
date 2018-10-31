<?php

class FAQListView extends View {

    public function display() {
        echo "<h1>FAQs</h1>";
        echo "<h2>Hier finden Sie die Antworten auf Ihre Fragen!</h2>";
        echo "<dl id=\"faqs\">\n";
        foreach ($this->list as $faq) {
            echo "<dt>{$faq->getQuestion()}</dt><dd>{$faq->getAnswer()}</dd>\n";
        }
        echo "</dl>\n";
    }

}

