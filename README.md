# ACM Contact Form WordPress Plugin

An example plugin using the Atlas Content Modeler crud api to collect data on the front-end from a contact form and store the data as an entry model.

This will also use the crud api validation to enfore the correct data.

**Do not use this as your contact form. As it provides no spam protection.**

## Getting Started
1. Install and activate the [Atlas Content Modeler](https://wordpress.org/plugins/atlas-content-modeler/) plugin.
2. Create a `Contact` model with the following fields.
  - Name (`name` slug) as required text field.
  - E-Mail (`email` slug) as required email field.
  - Comment (`comment` slug) as required multi-line text field.
3. Install and activate the ACM Contact Form plugin.
4. Add the `[acm_contact_form]` shortcode to a published page.
