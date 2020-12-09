<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* table/structure/table_structure_row.twig */
class __TwigTemplate_97f494209a5d733f4100f0507343290b6dd51a7cf1460abf66a224b7437fdc65 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<td class=\"center print_ignore\">
    <input type=\"checkbox\" class=\"checkall\" name=\"selected_fld[]\" value=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["row"]) ? $context["row"] : null), "Field", [], "array"), "html", null, true);
        echo "\" id=\"checkbox_row_";
        echo twig_escape_filter($this->env, (isset($context["rownum"]) ? $context["rownum"] : null), "html", null, true);
        echo "\"/>
</td>
<td class=\"right\">";
        // line 4
        echo twig_escape_filter($this->env, (isset($context["rownum"]) ? $context["rownum"] : null), "html", null, true);
        echo "</td>
<th class=\"nowrap\">
    <label for=\"checkbox_row_";
        // line 6
        echo twig_escape_filter($this->env, (isset($context["rownum"]) ? $context["rownum"] : null), "html", null, true);
        echo "\">
        ";
        // line 7
        echo (isset($context["displayed_field_name"]) ? $context["displayed_field_name"] : null);
        echo "
    </label>
</th>
<td ";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["type_nowrap"]) ? $context["type_nowrap"] : null), "html", null, true);
        echo ">
    <bdo dir=\"ltr\" lang=\"en\">
        ";
        // line 12
        echo $this->getAttribute((isset($context["extracted_columnspec"]) ? $context["extracted_columnspec"] : null), "displayed_type", [], "array");
        echo "
        ";
        // line 13
        if (((((isset($context["relation_commwork"]) ? $context["relation_commwork"] : null) && (isset($context["relation_mimework"]) ? $context["relation_mimework"] : null)) && (isset($context["browse_mime"]) ? $context["browse_mime"] : null)) && $this->getAttribute($this->getAttribute(        // line 14
(isset($context["mime_map"]) ? $context["mime_map"] : null), $this->getAttribute((isset($context["row"]) ? $context["row"] : null), "Field", [], "array"), [], "array", false, true), "mimetype", [], "array", true, true))) {
            // line 15
            echo "            <br />MIME: ";
            echo twig_escape_filter($this->env, twig_lower_filter($this->env, twig_replace_filter($this->getAttribute($this->getAttribute((isset($context["mime_map"]) ? $context["mime_map"] : null), $this->getAttribute((isset($context["row"]) ? $context["row"] : null), "Field", [], "array"), [], "array"), "mimetype", [], "array"), ["_" => "/"])), "html", null, true);
            echo "
        ";
        }
        // line 17
        echo "    </bdo>
</td>
<td>
";
        // line 20
        if ( !twig_test_empty((isset($context["field_charset"]) ? $context["field_charset"] : null))) {
            // line 21
            echo "    <dfn title=\"";
            echo twig_escape_filter($this->env, PhpMyAdmin\Charsets::getCollationDescr((isset($context["field_charset"]) ? $context["field_charset"] : null)), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["field_charset"]) ? $context["field_charset"] : null), "html", null, true);
            echo "</dfn>
";
        }
        // line 23
        echo "</td>
<td class=\"column_attribute nowrap\">";
        // line 24
        echo twig_escape_filter($this->env, (isset($context["attribute"]) ? $context["attribute"] : null), "html", null, true);
        echo "</td>
<td>";
        // line 25
        echo twig_escape_filter($this->env, ((($this->getAttribute((isset($context["row"]) ? $context["row"] : null), "Null", [], "array") == "YES")) ? (_gettext("Yes")) : (_gettext("No"))), "html", null, true);
        echo "</td>
<td class=\"nowrap\">
    ";
        // line 27
        if ( !(null === $this->getAttribute((isset($context["row"]) ? $context["row"] : null), "Default", [], "array"))) {
            // line 28
            echo "        ";
            if (($this->getAttribute((isset($context["extracted_columnspec"]) ? $context["extracted_columnspec"] : null), "type", [], "array") == "bit")) {
                // line 29
                echo "            ";
                echo twig_escape_filter($this->env, PhpMyAdmin\Util::convertBitDefaultValue($this->getAttribute((isset($context["row"]) ? $context["row"] : null), "Default", [], "array")), "html", null, true);
                echo "
        ";
            } else {
                // line 31
                echo "            ";
                echo $this->getAttribute((isset($context["row"]) ? $context["row"] : null), "Default", [], "array");
                echo "
        ";
            }
            // line 33
            echo "    ";
        } else {
            // line 34
            echo "        <em>";
            echo _pgettext(            "None for default", "None");
            echo "</em>
    ";
        }
        // line 36
        echo "</td>
";
        // line 37
        if ((isset($context["show_column_comments"]) ? $context["show_column_comments"] : null)) {
            // line 38
            echo "    <td>
        ";
            // line 39
            echo twig_escape_filter($this->env, (isset($context["comments"]) ? $context["comments"] : null), "html", null, true);
            echo "
    </td>
";
        }
        // line 42
        echo "<td class=\"nowrap\">";
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->getAttribute((isset($context["row"]) ? $context["row"] : null), "Extra", [], "array")), "html", null, true);
        echo "</td>
";
        // line 43
        if (( !(isset($context["tbl_is_view"]) ? $context["tbl_is_view"] : null) &&  !(isset($context["db_is_system_schema"]) ? $context["db_is_system_schema"] : null))) {
            // line 44
            echo "    <td class=\"edit center print_ignore\">
        <a class=\"change_column_anchor ajax\" href=\"tbl_structure.php";
            // line 46
            echo twig_escape_filter($this->env, (isset($context["url_query"]) ? $context["url_query"] : null), "html", null, true);
            echo "&amp;field=";
            echo twig_escape_filter($this->env, twig_urlencode_filter($this->getAttribute((isset($context["row"]) ? $context["row"] : null), "Field", [], "array")), "html", null, true);
            echo "&amp;change_column=1\">
            ";
            // line 47
            echo $this->getAttribute((isset($context["titles"]) ? $context["titles"] : null), "Change", [], "array");
            echo "
        </a>
    </td>
    <td class=\"drop center print_ignore\">
        <a class=\"drop_column_anchor ajax\" href=\"sql.php\" data-post=\"";
            // line 51
            echo twig_escape_filter($this->env, (isset($context["url_query"]) ? $context["url_query"] : null), "html", null, true);
            echo "&amp;sql_query=";
            // line 52
            echo twig_escape_filter($this->env, twig_urlencode_filter((((("ALTER TABLE " . PhpMyAdmin\Util::backquote((isset($context["table"]) ? $context["table"] : null))) . " DROP ") . PhpMyAdmin\Util::backquote($this->getAttribute(            // line 53
(isset($context["row"]) ? $context["row"] : null), "Field", [], "array"))) . ";")), "html", null, true);
            // line 54
            echo "&amp;dropped_column=";
            echo twig_escape_filter($this->env, twig_urlencode_filter($this->getAttribute((isset($context["row"]) ? $context["row"] : null), "Field", [], "array")), "html", null, true);
            echo "&amp;purge=1&amp;message_to_show=";
            // line 55
            echo twig_escape_filter($this->env, twig_urlencode_filter(sprintf(_gettext("Column %s has been dropped."), twig_escape_filter($this->env, $this->getAttribute((isset($context["row"]) ? $context["row"] : null), "Field", [], "array")))), "html", null, true);
            echo "\">
            ";
            // line 56
            echo $this->getAttribute((isset($context["titles"]) ? $context["titles"] : null), "Drop", [], "array");
            echo "
        </a>
    </td>
";
        }
    }

    public function getTemplateName()
    {
        return "table/structure/table_structure_row.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  177 => 56,  173 => 55,  169 => 54,  167 => 53,  166 => 52,  163 => 51,  156 => 47,  150 => 46,  147 => 44,  145 => 43,  140 => 42,  134 => 39,  131 => 38,  129 => 37,  126 => 36,  120 => 34,  117 => 33,  111 => 31,  105 => 29,  102 => 28,  100 => 27,  95 => 25,  91 => 24,  88 => 23,  80 => 21,  78 => 20,  73 => 17,  67 => 15,  65 => 14,  64 => 13,  60 => 12,  55 => 10,  49 => 7,  45 => 6,  40 => 4,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "table/structure/table_structure_row.twig", "/var/www/html/pvp/adminsqlpvp/templates/table/structure/table_structure_row.twig");
    }
}
