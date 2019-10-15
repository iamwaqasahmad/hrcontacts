
{{ form("contacts/save", 'role': 'form') }}


    {{ content() }}

    <h2>Edit contacts</h2>

    <fieldset>

        {% for element in form %}
            {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
                {{ element }}
            {% else %}
                <div class="form-group">
                    {{ element.label() }}
                    {{ element.render(['class': 'form-control']) }}
                </div>
            {% endif %}
        {% endfor %}

    </fieldset>
    <ul class="pager">

            <li class="pull-right">
                {{ submit_button("Save", "class": "btn btn-success") }}
            </li>
            <li class="previous pull-left">
                            {{ link_to("contacts", "&larr; Go Back") }}
                        </li>
        </ul>


</form>
