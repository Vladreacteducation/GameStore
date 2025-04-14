import { useBlockProps } from '@wordpress/block-editor';

export default function save() {
	return (
		<p { ...useBlockProps.save() }>
			{ 'Blocks Gamestore – hello from the saved content!' }
		</p>
	);
}
