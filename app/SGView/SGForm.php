<?php

namespace App\SGView;

use Illuminate\Support\HtmlString;

/**
 * Description of SGForm
 *
 * @author ervinne
 */
class SGForm {

    public static function input($label, $field, $properties = []) {

        $viewData = [
            "type"              => array_key_exists("type", $properties) ? $properties["type"] : "text",
            "label"             => $label,
            "field"             => $field,
            "value"             => array_key_exists("value", $properties) && $properties["value"] ? $properties["value"] : NULL,
            "readonly"          => array_key_exists("readonly", $properties) && $properties["readonly"] ? "readonly" : "",
            "tabIndex"          => array_key_exists("tabIndex", $properties) ? 'tabindex="' . $properties["tabIndex"] . '"' : "",
            "additionalClasses" => array_key_exists("class", $properties) ? $properties["class"] : "",
            "mode"              => array_key_exists("mode", $properties) ? $properties["mode"] : "view",
        ];

        return new HtmlString(view('sg.elements.input', $viewData));
    }

    public static function select($label, $field, $options, $properties = []) {
        $multipleProperty = "";

        $value = array_key_exists("value", $properties) && $properties["value"] ? $properties["value"] : NULL;

        if (isset($properties["multiple"]) && $properties["multiple"]) {
            $multipleProperty = 'multiple="multiple"';
            $value            = isset($value) ? explode(',', $value) : [];

            $field .= "[]";
        } else {
            $properties["multiple"] = false;
        }

        $viewData = [
            "label"              => $label,
            "field"              => $field,
            "options"            => $options,
            "multipleProperty"   => $multipleProperty,
            "multiple"           => $properties["multiple"],
            "value"              => $value,
            "optionValueField"   => array_key_exists("optionValueField", $properties) && $properties["optionValueField"] ? $properties["optionValueField"] : NULL,
            "optionDisplayField" => array_key_exists("optionDisplayField", $properties) && $properties["optionDisplayField"] ? $properties["optionDisplayField"] : NULL,
            "readonly"           => array_key_exists("readonly", $properties) && $properties["readonly"] ? "readonly" : "",
            "tabIndex"           => array_key_exists("tabIndex", $properties) ? 'tabindex="' . $properties["tabIndex"] . '"' : "",
            "additionalClasses"  => array_key_exists("class", $properties) ? $properties["class"] : "",
            "mode"               => array_key_exists("mode", $properties) ? $properties["mode"] : "view",
        ];

        return new HtmlString(view('sg.elements.select', $viewData));
    }

}
