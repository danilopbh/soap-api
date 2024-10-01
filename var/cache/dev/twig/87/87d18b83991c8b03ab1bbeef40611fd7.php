<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* soap/capital_city.html.twig */
class __TwigTemplate_11cb43a7680d1e47169f54056a7653c6 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "soap/capital_city.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "soap/capital_city.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html>
<head>
    <title>Pesquisar Capital</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .flash-success {
            color: green;
            font-weight: bold;
        }
        .fade-out {
            opacity: 0;
        }
        /* Estilo para os botões */
        form {
            display: inline; /* Garante que os formulários fiquem lado a lado */
        }

        button {
            margin-left: 5px; /* Espaçamento entre os botões */
            padding: 5px 10px; /* Tamanho dos botões */
            cursor: pointer; /* Cursor de mão ao passar o mouse */
        }
    </style>
</head>

<body>
    <h2>Pesquisar Capital de um País</h2>
    
    <form action=\"";
        // line 42
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("CapitalCity_request");
        yield "\" method=\"get\">
        <label for=\"country_code\">Código ISO do País:</label>
        <input type=\"text\" id=\"country_code\" name=\"country_code\" placeholder=\"ex.: US, BR\" required>
        <button type=\"submit\">Pesquisar</button>
    </form>

    ";
        // line 48
        if ( !(null === (isset($context["capitalCity"]) || array_key_exists("capitalCity", $context) ? $context["capitalCity"] : (function () { throw new RuntimeError('Variable "capitalCity" does not exist.', 48, $this->source); })()))) {
            // line 49
            yield "        <h2>País: ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["countryName"]) || array_key_exists("countryName", $context) ? $context["countryName"] : (function () { throw new RuntimeError('Variable "countryName" does not exist.', 49, $this->source); })()), "html", null, true);
            yield "</h2>
        <h2>Capital: ";
            // line 50
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["capitalCity"]) || array_key_exists("capitalCity", $context) ? $context["capitalCity"] : (function () { throw new RuntimeError('Variable "capitalCity" does not exist.', 50, $this->source); })()), "html", null, true);
            yield "</h2>
    ";
        }
        // line 52
        yield "    
    <hr>
    
    <h2>Inserir País</h2>
    <form action=\"";
        // line 56
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("test_insert_form");
        yield "\" method=\"post\">
        <label for=\"country_code\">Código ISO:</label>
        <input type=\"text\" id=\"country_code\" name=\"country_code\" required>
        
        <label for=\"country_name\">Nome do País:</label>
        <input type=\"text\" id=\"country_name\" name=\"country_name\" required>
        
        <label for=\"capital_city\">Capital:</label>
        <input type=\"text\" id=\"capital_city\" name=\"capital_city\" required>
        
        <button type=\"submit\">Inserir País</button>
    </form>
    
    <hr>

    <h2>Países que já foram cadastrados no banco</h2>
    <table>
        <thead>
            <tr>
                <th>Código ISO</th>
                <th>Nome do País</th>
                <th>Capital</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            ";
        // line 82
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["countryList"]) || array_key_exists("countryList", $context) ? $context["countryList"] : (function () { throw new RuntimeError('Variable "countryList" does not exist.', 82, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["country"]) {
            // line 83
            yield "                <tr>
                    <td>";
            // line 84
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["country"], "countryCode", [], "any", false, false, false, 84), "html", null, true);
            yield "</td>
                    <td>";
            // line 85
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["country"], "countryName", [], "any", false, false, false, 85), "html", null, true);
            yield "</td>
                    <td>";
            // line 86
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["country"], "capitalCity", [], "any", false, false, false, 86), "html", null, true);
            yield "</td>
                    <td>
                        <form action=\"";
            // line 88
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("country_update", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["country"], "id", [], "any", false, false, false, 88)]), "html", null, true);
            yield "\" method=\"post\" style=\"display:inline;\">
                            <input type=\"text\" name=\"country_code\" value=\"";
            // line 89
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["country"], "countryCode", [], "any", false, false, false, 89), "html", null, true);
            yield "\" required>
                            <input type=\"text\" name=\"country_name\" value=\"";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["country"], "countryName", [], "any", false, false, false, 90), "html", null, true);
            yield "\" required>
                            <input type=\"text\" name=\"capital_city\" value=\"";
            // line 91
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["country"], "capitalCity", [], "any", false, false, false, 91), "html", null, true);
            yield "\" required>
                            <button type=\"submit\">Atualizar</button>
                        </form>
                        <form action=\"";
            // line 94
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("test_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["country"], "id", [], "any", false, false, false, 94)]), "html", null, true);
            yield "\" method=\"post\" style=\"display:inline;\">
                            <button type=\"submit\" onclick=\"return confirm('Tem certeza que deseja excluir este país?');\">Excluir</button>
                        </form>
                    </td>
                </tr>
            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 100
            yield "                <tr>
                    <td colspan=\"4\">Nenhum país cadastrado.</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['country'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 104
        yield "        </tbody>
    </table>
    
    ";
        // line 107
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 107, $this->source); })()), "flashes", ["success"], "method", false, false, false, 107));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 108
            yield "        <div class=\"flash-success\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "</div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 110
        yield "
    <hr>
    
    <h2>Código ISO de alguns países que podem ser usados na pesquisa</h2>
    <table>
        <thead>
            <tr>
                <th>Código ISO</th>
                <th>Nome do País</th>
            </tr>
        </thead>
        <tbody>
            ";
        // line 122
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["countries"]) || array_key_exists("countries", $context) ? $context["countries"] : (function () { throw new RuntimeError('Variable "countries" does not exist.', 122, $this->source); })()));
        foreach ($context['_seq'] as $context["code"] => $context["name"]) {
            // line 123
            yield "                <tr>
                    <td>";
            // line 124
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["code"], "html", null, true);
            yield "</td>
                    <td>";
            // line 125
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["name"], "html", null, true);
            yield "</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['code'], $context['name'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 128
        yield "        </tbody>
    </table>
        <script>
        document.addEventListener(\"DOMContentLoaded\", function() {
            const successMessages = document.querySelectorAll('.flash-success');
            successMessages.forEach(message => {
                setTimeout(() => {
                    message.classList.add('fade-out');
                    setTimeout(() => {
                        message.remove();
                    }, 500); // Tempo para esperar o efeito de fade-out
                }, 3000); // Tempo em milissegundos para a mensagem desaparecer
            });
        });
    </script>
</body>
</html>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "soap/capital_city.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  258 => 128,  249 => 125,  245 => 124,  242 => 123,  238 => 122,  224 => 110,  215 => 108,  211 => 107,  206 => 104,  197 => 100,  186 => 94,  180 => 91,  176 => 90,  172 => 89,  168 => 88,  163 => 86,  159 => 85,  155 => 84,  152 => 83,  147 => 82,  118 => 56,  112 => 52,  107 => 50,  102 => 49,  100 => 48,  91 => 42,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
    <title>Pesquisar Capital</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .flash-success {
            color: green;
            font-weight: bold;
        }
        .fade-out {
            opacity: 0;
        }
        /* Estilo para os botões */
        form {
            display: inline; /* Garante que os formulários fiquem lado a lado */
        }

        button {
            margin-left: 5px; /* Espaçamento entre os botões */
            padding: 5px 10px; /* Tamanho dos botões */
            cursor: pointer; /* Cursor de mão ao passar o mouse */
        }
    </style>
</head>

<body>
    <h2>Pesquisar Capital de um País</h2>
    
    <form action=\"{{ path('CapitalCity_request') }}\" method=\"get\">
        <label for=\"country_code\">Código ISO do País:</label>
        <input type=\"text\" id=\"country_code\" name=\"country_code\" placeholder=\"ex.: US, BR\" required>
        <button type=\"submit\">Pesquisar</button>
    </form>

    {% if capitalCity is not null %}
        <h2>País: {{ countryName }}</h2>
        <h2>Capital: {{ capitalCity }}</h2>
    {% endif %}
    
    <hr>
    
    <h2>Inserir País</h2>
    <form action=\"{{ path('test_insert_form') }}\" method=\"post\">
        <label for=\"country_code\">Código ISO:</label>
        <input type=\"text\" id=\"country_code\" name=\"country_code\" required>
        
        <label for=\"country_name\">Nome do País:</label>
        <input type=\"text\" id=\"country_name\" name=\"country_name\" required>
        
        <label for=\"capital_city\">Capital:</label>
        <input type=\"text\" id=\"capital_city\" name=\"capital_city\" required>
        
        <button type=\"submit\">Inserir País</button>
    </form>
    
    <hr>

    <h2>Países que já foram cadastrados no banco</h2>
    <table>
        <thead>
            <tr>
                <th>Código ISO</th>
                <th>Nome do País</th>
                <th>Capital</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            {% for country in countryList %}
                <tr>
                    <td>{{country.countryCode}}</td>
                    <td>{{country.countryName}}</td>
                    <td>{{country.capitalCity}}</td>
                    <td>
                        <form action=\"{{ path('country_update', {'id': country.id}) }}\" method=\"post\" style=\"display:inline;\">
                            <input type=\"text\" name=\"country_code\" value=\"{{ country.countryCode }}\" required>
                            <input type=\"text\" name=\"country_name\" value=\"{{ country.countryName }}\" required>
                            <input type=\"text\" name=\"capital_city\" value=\"{{ country.capitalCity }}\" required>
                            <button type=\"submit\">Atualizar</button>
                        </form>
                        <form action=\"{{ path('test_delete', {'id': country.id}) }}\" method=\"post\" style=\"display:inline;\">
                            <button type=\"submit\" onclick=\"return confirm('Tem certeza que deseja excluir este país?');\">Excluir</button>
                        </form>
                    </td>
                </tr>
            {% else %}
                <tr>
                    <td colspan=\"4\">Nenhum país cadastrado.</td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
    
    {% for message in app.flashes('success') %}
        <div class=\"flash-success\">{{ message }}</div>
    {% endfor %}

    <hr>
    
    <h2>Código ISO de alguns países que podem ser usados na pesquisa</h2>
    <table>
        <thead>
            <tr>
                <th>Código ISO</th>
                <th>Nome do País</th>
            </tr>
        </thead>
        <tbody>
            {% for code, name in countries %}
                <tr>
                    <td>{{ code }}</td>
                    <td>{{ name }}</td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
        <script>
        document.addEventListener(\"DOMContentLoaded\", function() {
            const successMessages = document.querySelectorAll('.flash-success');
            successMessages.forEach(message => {
                setTimeout(() => {
                    message.classList.add('fade-out');
                    setTimeout(() => {
                        message.remove();
                    }, 500); // Tempo para esperar o efeito de fade-out
                }, 3000); // Tempo em milissegundos para a mensagem desaparecer
            });
        });
    </script>
</body>
</html>", "soap/capital_city.html.twig", "/home/isaac/projects/soap-api/templates/soap/capital_city.html.twig");
    }
}
