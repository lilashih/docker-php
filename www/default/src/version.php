<?php

function versions(array $versions, $path)
{
    $options = implode('', array_map(function ($version) {
        $selected = strpos(phpversion(), $version) !== false ? 'selected' : '';
        return "<option value=\"{$version}\" {$selected}>{$version}</option>";
    }, $versions));

    echo <<<HTML
    <div style="margin-top: 20px; text-align: center; display: flex; justify-content: center; font-size: 1.5em;">
        <div style="padding-right: 10px;">PHP versions: </div>
        <div>
            <select style="font-size: 0.9em; width: 80px;" onchange="location = `/{$path}/` + this.value;">
                $options
            </select>
        </div>
    </div>
HTML;
}