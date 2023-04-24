<?php

namespace App\Services;
class LatexParser
{
    public function parse($latexContent)
    {
        $pattern = '/\\\\section\*{(?P<section>[A-Z0-9]+)}\n(?P<task>.*?)\\\\begin{solution}\n(?P<solution>.*?)\\\\end{solution}/s';
        preg_match_all($pattern, $latexContent, $matches, PREG_SET_ORDER);

        $results = [];

        foreach ($matches as $match) {
            $result = [];
            $result['section'] = $match['section'];
            $result['task'] = $this->cleanLatex($match['task']);
            $result['solution'] = $this->cleanLatex($match['solution']);
            $result['image'] = $this->extractImage($match['task']);

            $results[] = $result;
        }

        return $results;
    }

    private function extractImage($latex)
    {
        $pattern = '/\\\\includegraphics{(?P<filename>[^{}]+)}/';
        preg_match($pattern, $latex, $matches);

        return isset($matches['filename']) ? $matches['filename'] : null;
    }

    private function cleanLatex($latex)
    {
        // Remove LaTeX commands
        $pattern = '/\\\(?!dfrac)[a-zA-Z]+\*?(?:\[[^\]]*\])?(?:\{[^\}]*\})?/';

        $latex = preg_replace($pattern, '', $latex);
        // Remove line breaks and trailing/leading white space
        $latex = preg_replace('/\s+/', ' ', $latex);
        $latex = trim($latex);

        return $latex;
    }

}
