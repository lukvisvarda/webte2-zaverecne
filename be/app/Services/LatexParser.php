<?php

namespace App\Services;
class LatexParser
{
//    public function parse($latexContent)
//    {
//        $pattern = '/\\\\section\*{(?P<section>[A-Z0-9]+)}\n(?P<task>.*?)\\\\begin{solution}\n(?P<solution>.*?)\\\\end{solution}/s';
//        preg_match_all($pattern, $latexContent, $matches, PREG_SET_ORDER);
//
//        $results = [];
//
//        foreach ($matches as $match) {
//            $result = [];
//            $result['section'] = $match['section'];
//            $result['task'] = $this->cleanLatex($match['task']);
//            $result['solution'] = $this->cleanLatex($match['solution']);
//            $result['image'] = $this->extractImage($match['task']);
//
//            $results[] = $result;
//        }
//
//        return $results;
//    }

    public function parse($content) {
        $result = [];
        preg_match_all('/\\\\section\*{(?<name>[^}]+)}\s*\\\\begin{task}\s*(?<task>.*?)\s*\\\\end{task}\s*\\\\begin{solution}\s*(?<solution>.*?)\s*\\\\end{solution}/s', $content, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $task = preg_replace('/\\\\begin{.*?}|\\\\end{.*?}/', '', $match['task']); // Odstrániť \begin a \end z tasku
            $task = preg_replace('/\\\\includegraphics{[^{}]+}/', '', $task); // Vymazať príkaz \includegraphics z tasku
            $solution = preg_replace('/\\\\begin{.*?}|\\\\end{.*?}/', '', $match['solution']); // Odstrániť \begin a \end z riešenia
            $result[] = [
                'name' => $match['name'],
                'task' => str_replace(['\\\\', '\n'], ['', ''], $task),
                'solution' => str_replace(['\n'], [''], $solution),
                'image' => $this->extractImage($match['task']) ?? '',
            ];
        }
        return json_encode($result);
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
