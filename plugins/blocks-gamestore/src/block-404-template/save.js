import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {
const { title, description, backgroundImage, foregroundImage } = attributes;


	const blockProps = useBlockProps.save({
		style: {
			backgroundImage: backgroundImage ? `url(${backgroundImage})` : 'none'
		}
	});

	return (
		<div {...blockProps}>
			 <div className="wrapper">
			<RichText.Content
				tagName="h1"
				value={title}
				style={{ fontSize: '48px', fontWeight: 'bold' }}
			/>
			<RichText.Content
				tagName="p"
				value={description}
				style={{ fontSize: '18px', marginBottom: '30px' }}
			/>
			{foregroundImage && (
	<img
		src={foregroundImage}
		alt="404"
	/>
)}

			<a
				href="/"
			>
				Go Back
			</a>
		</div>
		</div>
	);
}
