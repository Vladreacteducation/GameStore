import { useBlockProps, RichText, InspectorControls, MediaUpload, MediaPlaceholder } from '@wordpress/block-editor';
import { Button, PanelBody, TextControl, TextareaControl, ToggleControl } from '@wordpress/components';
import { useState } from '@wordpress/element';
import './editor.scss';

// component slide item
const SlideItem = ({index, slide, onImageChange, onRemove}) => {
return (
	<div className="slide-item">

		<div className="slide-item-image">

        <p>Light Version Logo</p>

          {slide.lightImage &&  <div className='image-box'><img src={slide.lightImage} alt="Slide Image" /></div>}
			<MediaPlaceholder
			 icon='format-image'
			 onSelect={(media) => onImageChange( media.url, index, "lightImage")}
			onSelectURL={(url) => onImageChange(url, index, "lightImage")}
			labels={{
				title: 'Slide Light Image',
				instructions: 'Upload an image for the slide.',
			}}
			accept='image/*'
			allowedTypes={['image']}
			multiple={false}
			/>

		</div>

		<div className="slide-item-image">

        <p>Dark Version Logo</p>

          {slide.darkImage &&  <div className='image-box'><img src={slide.darkImage} alt="Slide Image" /></div>}
			<MediaPlaceholder
			 icon='format-image'
			 onSelect={(media) => onImageChange( media.url, index, 'darkImage')}
			onSelectURL={(url) => onImageChange(url, index, "darkImage")}
			labels={{
				title: 'Slide Dark Image',
				instructions: 'Upload an image for the slide.',
			}}
			accept='image/*'
			allowedTypes={['image']}
			multiple={false}
			/>

		</div>
		<Button className='components-button is-destructive' onClick={() => onRemove(index)}>
			Remove Slide
		</Button>
	</div>
)

}

export default function Edit({ attributes, setAttributes }) {
	const { title, description, link, video, linkAnchor, image, isVideo, slides: initialSlides } = attributes;

	// Toggle state for choosing between image and video upload
	const [isVideoUpload, setIsVideoUpload] = useState(isVideo ?? false);
	const [slides, setSlides] = useState(initialSlides|| []);

	// Handle slide upload

	const onSlideChange = (updatedSlide, index) => {
		const updatedSlides = [...slides];
		updatedSlides[index] = updatedSlide;
		setSlides(updatedSlides);
		setAttributes({ slides: updatedSlides });
	}

//  add slide
const addSlide = () => {
	const newSlide = { lightImage: '', darkImage: '' };
	const updatedSlides = [...slides, newSlide];
setSlides(updatedSlides);
setAttributes({ slides: updatedSlides });
}

// Remove slide
const removeSlide = (index) => {
	const updatedSlides = [...slides];
	updatedSlides.splice(index, 1);	
	setSlides(updatedSlides);
	setAttributes({ slides: updatedSlides });
	}

	const handleImageChange = (url, index, imageType) => {
		const updatedSlides = {...slides[index],[imageType]: url};
		onSlideChange(updatedSlides, index);
	
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title="Hero Block Settings">
					<TextControl
						label="Title"
						value={title}
						onChange={(title) => setAttributes({ title })}
						help="Add a title for the hero section"
					/>
					<TextareaControl
						label="Description"
						value={description}
						onChange={(description) => setAttributes({ description })}
						help="Add a description for the hero section"
					/>
					<TextControl
						label="Button Url"
						value={link}
						onChange={(link) => setAttributes({ link })}
						help="Add a link for the hero section"
					/>
					<TextControl
						label="Button Value"
						value={linkAnchor}
						onChange={(linkAnchor) => setAttributes({ linkAnchor })}
						help="Add a link anchor for the hero section"
					/>
					<ToggleControl
						label="Upload Video"
						checked={isVideoUpload}
						onChange={(value) => {
							setIsVideoUpload(value);
							setAttributes({ isVideo: value, video: '', image: '' });
						}}
					/>
					{isVideoUpload ? (
						video && (
							<video controls muted style={{ width: '100%' }}>
								<source src={video} type="video/mp4" />
							</video>
						)
					) : (
						image && <img src={image} alt="Uploaded Media" style={{ width: '100%' }} />
					)}
					<MediaUpload
						onSelect={(media) => {
							if (isVideoUpload) {
								setAttributes({ video: media.url });
							} else {
								setAttributes({ image: media.url });
							}
						}}
						allowedTypes={isVideoUpload ? ['video'] : ['image']}
						render={({ open }) => (
							<button className="components-button is-secondary" onClick={open}>
								{isVideoUpload ? 'Upload Video' : 'Upload Image'}
							</button>
						)}
					/>
				</PanelBody>

				<PanelBody title="Hero Slider">
					{slides.map((slide, index) => (
						<SlideItem 
							key={index}
							index={index}
							slide={slide}
							onImageChange={handleImageChange}
							onRemove = {removeSlide}
						
						/>
					))}
					
					<Button className='components-button is-primary' onClick={addSlide}>
						Add Slide</Button>
 
					</PanelBody>
			</InspectorControls>

			<div {...useBlockProps()}>
				{isVideoUpload && video && (
					<video
						className="video-background"
						loop
						autoPlay
						muted
						playsInline
						width="100%"
						height="100%"
					>
						<source className="source-element" src={video} type="video/mp4" />
					</video>
				)}

				{!isVideoUpload && image && <img className='image-bg' src={image} alt="Background" />}
				<div className="hero-mask">
					<div className="hero-content">
						<RichText
							tagName="h1"
							className="hero-title"
							value={title}
							onChange={(title) => setAttributes({ title })}
							placeholder="Add a title for the hero section"
						/>
						<RichText
							tagName="p"
							className="hero-description"
							value={description}
							onChange={(description) => setAttributes({ description })}
							placeholder="Add a description for the hero section"
						/>
						{link && linkAnchor && (
							<a href={link} className="hero-button">
								{linkAnchor}
							</a>
						)}
					</div>
				</div>
			</div>
		</>
	);
}
