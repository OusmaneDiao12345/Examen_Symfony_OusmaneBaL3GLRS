{% block title %}Liste des Cours{% endblock %}

{% block body %}
    <h1>Liste des Cours</h1>
    <ul>
        {% for cours in cours %}
            <li>{{ cours.nom }} - {{ cours.module }} - {{ cours.professeur }} - {{ cours.classes }}</li>
        {% endfor %}
    </ul>
{% endblock %}
