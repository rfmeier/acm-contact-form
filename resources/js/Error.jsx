import { errorStyle } from './styles.js';

/**
 * Error component for ACM Contact Form plugin.
 *
 * @since 0.1.0
 *
 * @param {Object} props         - The component props object
 * @param {string} props.message - The error message.
 */
export default function Error({ message }) {
	return <div style={errorStyle}>{message}</div>;
}
