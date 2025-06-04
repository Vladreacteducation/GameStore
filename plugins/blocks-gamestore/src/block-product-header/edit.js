import { useBlockProps, RichText, InspectorControls, MediaPlaceholder } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import './editor.scss';

const LinkRepeater = ({ links, setLinks }) => {
  const addLink = () => {
    setLinks([...links, { url: "", anchor: "" }]);
  };

  const removeLink = (index) => {
    const updatedLinks = links.filter((_, i) => i !== index);
    setLinks(updatedLinks);
  };

  const updateLink = (index, key, value) => {
    const updatedLinks = [...links];
    updatedLinks[index][key] = value;
    setLinks(updatedLinks);
  };

  return (
    <div className="link-repeater">
      <h4>Manage Links</h4>
      {links.map((link, index) => (
        <div key={index} className="link-repeater-item">
          <TextControl
            label="URL"
            value={link.url}
            onChange={(value) => updateLink(index, "url", value)}
            placeholder="https://example.com"
          />
          <TextControl
            label="Anchor Text"
            value={link.anchor}
            onChange={(value) => updateLink(index, "anchor", value)}
            placeholder="Link text"
          />
          <Button
            variant="secondary"
            onClick={() => removeLink(index)}
            className="remove-link-button"
          >
            Remove Link
          </Button>
        </div>
      ))}
      <Button variant="primary" onClick={addLink} className="add-link-button">
        Add Link
      </Button>
    </div>
  );
};

export default function Edit({ attributes, setAttributes }) {
  const { title, styleType, image, links = [] } = attributes;

  const setLinks = (newLinks) => setAttributes({ links: newLinks });

	return (
    <>
    <InspectorControls>
      <PanelBody title={ __( 'Settings', 'blocks-gamestore' ) }>
        <TextControl
          label={ __( 'Title', 'blocks-gamestore' ) }
          value={ title }
          onChange={ ( title ) => setAttributes( { title } ) }
        />
        <SelectControl 
          label={ __( 'Select Type', 'blocks-gamestore' ) }
          value={ styleType }
          onChange={ ( styleType ) => setAttributes( { styleType } ) }
          options={[
            {label: "Archive Page", value: "archive"},
            {label: "Single Page", value: "single"},
          ]}
        />
        {image && (<img src={image} />)}
        <MediaPlaceholder
          icon="format-image"
          labels={ { title: 'Image' } }
          onSelect={ ( media ) => setAttributes( { image: media.url } ) }
          accept="image/*"
          allowedTypes={ [ 'image' ] }
          notices={ [ 'Image' ] }
        />
      </PanelBody>
      {styleType !== 'archive' && (
        <PanelBody title="Manage Links">
          <LinkRepeater links={links} setLinks={setLinks} />
        </PanelBody>
      )}
    </InspectorControls>
    <div { ...useBlockProps({
      className: "alignfull",
      style: {
        background: image ? `url(${image})` : undefined,
      }
    }) }>
      <div className='wrapper'>
        <RichText
          tagName="h1"
          className='shop-header-title'
          value={title}
          onChange={(title) => setAttributes({ title })}
        />
      </div>
		</div>
    </>
		
	);
}
