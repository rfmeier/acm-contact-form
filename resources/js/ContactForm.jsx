import Error from './Error.jsx';
import {
	formStyle,
	inputGroupStyle,
	labelStyle,
	inputStyle,
	successStyle,
} from './styles.js';

import { useState } from '@wordpress/element';

/**
 * Contact form for ACM Contact Form plugin.
 *
 * @since 0.1.0
 */
export default function ContactForm() {
	const [busy, setBusy] = useState(false);
	const [complete, setComplete] = useState(false);
	const [errors, setErrors] = useState({});
	const [formValues, setFormValues] = useState({});

	function handleInputChange(event) {
		const value =
			event.target.type === 'checkbox'
				? event.target.checked
				: event.target.value;

		const values = formValues;
		values[event.target.name] = value;

		setFormValues(values);
	}

	function handleFormSubmit(event) {
		event.preventDefault();

		if (complete) {
			return;
		}

		setBusy(true);
		setErrors({});

		fetch('/wp-json/acm/contacts', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				Accept: 'application/json',
			},
			body: JSON.stringify(formValues),
		})
			.then((response) => response.json())
			.then((response) => {
				return !response.success
					? setErrors(response.data)
					: setComplete(true);
			})
			.then(() => setBusy(complete));
	}

	return (
		<div
			className="acm-contact-form"
			style={formStyle}
			onSubmit={handleFormSubmit}
		>
			<form method="POST">
				<div style={inputGroupStyle}>
					<label htmlFor="contact-form-name" style={labelStyle}>
						Name
					</label>
					<input
						id="contact-form-name"
						type="text"
						name="name"
						style={inputStyle}
						onChange={handleInputChange}
						disabled={busy}
					/>
					{errors.name && <Error message={errors.name[0]} />}
				</div>

				<div style={inputGroupStyle}>
					<label htmlFor="contact-form-email" style={labelStyle}>
						E-mail
					</label>
					<input
						id="contact-form-email"
						type="text"
						name="email"
						style={inputStyle}
						onChange={handleInputChange}
						disabled={busy}
					/>
					{errors.email && <Error message={errors.email[0]} />}
				</div>

				<div style={inputGroupStyle}>
					<label htmlFor="contact-form-comment" style={labelStyle}>
						Comment
					</label>
					<textarea
						id="contact-form-comment"
						type="text"
						name="comment"
						style={inputStyle}
						onChange={handleInputChange}
						disabled={busy}
					></textarea>
					{errors.comment && <Error message={errors.comment[0]} />}
				</div>

				{complete ? (
					<div style={{ ...inputGroupStyle, ...successStyle }}>
						The form was successfully submitted!
					</div>
				) : (
					<div style={inputGroupStyle}>
						<button type="submit" disabled={busy}>
							{busy ? 'Submitting...' : 'Submit'}
						</button>
					</div>
				)}
			</form>
		</div>
	);
}
