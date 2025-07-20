import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
	RichText,
} from '@wordpress/block-editor';
import {
	PanelBody,
	Button,
	TextControl
} from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
const { title, description, backgroundImage, foregroundImage } = attributes;


	const blockProps = useBlockProps({
		style: {
			backgroundImage: backgroundImage ? `url(${backgroundImage})` : 'none'
		}
	});

	return (
		<>
			<InspectorControls>
				<PanelBody title="404 Settings" initialOpen={true}>
					<MediaUploadCheck>
						<MediaUpload
							onSelect={(media) => setAttributes({ backgroundImage: media.url })}
							allowedTypes={['image']}
							render={({ open }) => (
								<Button onClick={open} isSecondary>
									{backgroundImage ? 'Change Background' : 'Select Background'}
								</Button>
							)}
						/>
					</MediaUploadCheck>
					<TextControl
						label="Title"
						value={title}
						onChange={(value) => setAttributes({ title: value })}
					/>
					<TextControl
						label="Description"
						value={description}
						onChange={(value) => setAttributes({ description: value })}
					/>
				</PanelBody>
        <MediaUploadCheck>
	<MediaUpload
		onSelect={(media) => setAttributes({ foregroundImage: media.url })}
		allowedTypes={['image']}
		render={({ open }) => (
			<Button onClick={open} isSecondary>
				{foregroundImage ? 'Change Foreground Image' : 'Select Foreground Image'}
			</Button>
		)}
	/>
</MediaUploadCheck>

			</InspectorControls>

			<div {...blockProps}>
        <div className="wrapper">
				<RichText
					tagName="h1"
					value={title}
					onChange={(value) => setAttributes({ title: value })}
					placeholder={__('Page Not Found')}
					style={{ fontSize: '48px', fontWeight: 'bold' }}
				/>
				<RichText
					tagName="p"
					value={description}
					onChange={(value) => setAttributes({ description: value })}
					placeholder={__('Description')}
					style={{ fontSize: '18px', marginBottom: '30px' }}
				/>
        {foregroundImage && (
	<img
		src={foregroundImage}
		alt="404"
	/>
)}

				<a href="/">Go Back</a>
			</div>
      </div>
		</>
	);
}
