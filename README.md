# ACM Contact Form WordPress Plugin

[![Continuous Integration](https://github.com/rfmeier/acm-contact-form/actions/workflows/main.yml/badge.svg)](https://github.com/rfmeier/acm-contact-form/actions/workflows/main.yml)

An example plugin using the Atlas Content Modeler crud api to collect data on the front-end from a contact form and store the data as an entry model.

**Do not use this as your contact form. As it provides no spam protection.**

This plugin is the result of a hack-a-thon project in order to see the Atlas Content Modeler CRUP API in action.

## Getting Started
1. Install and activate the [Atlas Content Modeler](https://wordpress.org/plugins/atlas-content-modeler/) plugin.
2. [Download](https://github.com/rfmeier/acm-contact-form/releases) the latest release of ACM Contact Form.
3. Install and activate the ACM Contact Form plugin.
4. Create a `Contact` model with the following fields.
    - Name (`name` slug) as required text field.
    - E-Mail (`email` slug) as required email field.
    - Comment (`comment` slug) as required multi-line text field.
5. Install and activate the ACM Contact Form plugin.
6. Add the `[acm_contact_form]` shortcode to a published page.
